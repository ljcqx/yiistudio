<?php
/**
 * This class exists to help the bootstrap installer automate a few processes such as form validation and
 * field verification. It should only be used and called during the pre-bootstrap phases.
 * This also _significantly_ declutters the pre-bootstrap installer of unnecessary PHP Code, which means it
 * remains most HTML and jQuery
 */
class InstallHelper
{
    /**
     * Checks to see if Yii exists at the provided path
     * @param string $path  Path to Yii Framework
     */
    public function pathExists($path = "")
    {
        // Use forward slashes always, should fix Windows Install issue
        $path = str_replace('\\', '/', $path);
        if ($path[strlen($path)-1] != '/')
            $path .= '/';
        
        // Check if yii.php exists
        if (file_exists($path . '/yii.php'))
        {
            $this->setPath($path);
            $this->exitWithResponse(array('pathExists' => true));
        }
        
        $this->exitWithResponse(array('pathExists' => false));
    }
    
    /**
     * Initiates the Yii download
     * @param array $data   The data we need to know to initiate the download
     */
    public function initYiiDownload(array $data = array())
    {
        try {
            // Replace pathspec
            $data['runtime'] = str_replace('\\', '/', $data['runtime']);
            if ($data['runtime'][strlen($data['runtime'])-1] != '/')
                $data['runtime'] .= '/';
            
            // Create a progress file
            file_put_contents($data['runtime'] . 'progress.txt', '0');
            
            // Global variable for progress
            global $progress;
            $GLOBALS['progress'] = $data['runtime'] . 'progress.txt';
            
            // Set the target file
            $targetFile = fopen($data['runtime'] . 'yii.zip', 'w' );
            
            // Initiate the CURL request
            $ch = curl_init( $data['remote'] );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出
            curl_setopt( $ch, CURLOPT_NOPROGRESS, false );//启用时关闭curl传输的进度条，此项的默认设置为启用
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);//启用时会将服务器服务器返回的"Location: "放在header中递归的返回给服务器，使用CURLOPT_MAXREDIRS可以限定递归返回的数量
            curl_setopt( $ch, CURLOPT_PROGRESSFUNCTION, 'progressCallback' );//设置一个回调函数，有三个参数，第一个是cURL的资源句柄，第二个是一个文件描述符资源，第三个是长度。返回包含的数据
            //curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, array($this, 'progressFunction'));
            curl_setopt( $ch, CURLOPT_FILE, $targetFile );//设置输出文件的位置，值是一个资源类型，默认为STDOUT (浏览器)。
            //curl_setopt( $ch, CURLOPT_BUFFERSIZE, 128 );
            curl_exec( $ch );
            curl_close($ch);

            fclose($targetFile);
            
            // Extract the file
            $zip = new ZipArchive;
            $res = $zip->open($data['runtime'] . 'yii.zip');
            if ($res === true)
            {
                // Extract the directory
                $zip->extractTo($data['runtime']);
                $zip->close();
                
                // Remove the file
                unlink($data['runtime'] . 'yii.zip');
                
                // Set the path and prompt for a reload
                $this->setPath($data['runtime'] .  $data['version'] . '/framework/');
                $this->exitwithResponse(array('completed' => true));
            }
            
            $this->exitwithResponse(array('completed' => false, 'status' => 1));
        } 
        catch (Exception $e)
        {
            $this->exitwithResponse(array('completed' => false, 'status' => 2));
        }
    }

    public function checkDownloadProgress(array $data = array())
    {
         // Replace pathspec
        $data['runtime'] = str_replace('\\', '/', $data['runtime']);
        if ($data['runtime'][strlen($data['runtime'])-1] != '/')
            $data['runtime'] .= '/';
        
        // Get the status from the file
        $status = file_get_contents($data['runtime'] . 'progress.txt');
        
        // Clean up after oursevles
        if ($status == 100)
            unlink ($data['runtime'] . 'progress.txt');
        
        $this->exitWithResponse(array('progress' => $status));
    }
    
    /**
     * Sets the YiiPath in Session so the bootstrapper can take over
     * @param string $path      The path to Yii Framework
     */
    private function setPath($path)
    {
        session_start();
        $_SESSION['config']['params']['yiiPath'] = $path;
        session_write_close();
        return;
    }
    
    /**
     * Returns a json_encoded response then exits the script
     * @param array $response   The data we want to return
     */
    private function exitWithResponse(array $response = array())
    {
        header('Content-type: application/json');
        echo json_encode($response);
        exit();
    }
}

/**
 * CurlOPT progress callback
 */
function progressCallback( $download_size, $downloaded_size, $upload_size, $uploaded_size )
{
    static $previousProgress = 0;
    
    if ( $download_size == 0 )
        $status = 0;
    else
        $status = round( $downloaded_size * 100 / $download_size );
    
    if ( $status > $previousProgress)
    {
        $previousProgress = $status;
        $fp = fopen( $GLOBALS['progress'], 'w' );
        fputs( $fp, "$status" );
        fclose( $fp );
    }
}