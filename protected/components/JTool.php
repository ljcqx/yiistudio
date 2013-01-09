<?php
/**
 * @Filename: JTool.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012.12.26 14:04
 * @desc: Yii中的CComponent，CEvent与Behavior示例
 */
class JTool extends CComponent
{
    private $_width;

    public function getWidth(){
        return $this->_width ? $this->_width : 1;
    }

    public function setWidth($width){
        if($this->hasEventHandler('onChange')){
            $this->onChange(new CEvent());
        }
        $this->_width = $width;
    }

    public function onChange($event){
        $this->raiseEvent('onChange',$event);
    }
}
