<?php
/**
 * @Filename: TestController.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012.12.26 14:10
 */
class TestController extends Controller
{
    /*$j = new JTool();
    $j->onChange = array($this, "showChange");//给事件绑定handle showChange
    $j->width = 100;//调用setWidth,解除绑定的事件showChange*/

    function showChange(){
        echo 'change me';
    }


    /**
     * Yii AJAX CTreeView 实现动态加载无限级树
     */

    public function actionAjaxFillTree(){
        if(!Yii::app()->request->isAjaxRequest){
            Yii::app()->end();//exit;
        }
        $parentId = '0';
        if(isset($_GET['root']) and $_GET['root']!='source'){
            $parentId = (int)$_GET['root'];
        }
//        $sql='SELECT * FROM {{user}}';
//        $users=$connection->createCommand($sql)->queryAll();
        $sql = "SELECT c1.id, c1.coverageName AS text, c2.id!=0 as hasChildren FROM {{coverage}} AS c1 LEFT JOIN {{coverage}} AS c2 ON c1.id=c2.pid WHERE c1.pid<=>$parentId GROUP BY c1.id ORDER BY c1.coverageName ASC";
        $sql2 =  "SELECT m1.id, m1.coverageName AS text, m2.id IS NOT NULL AS hasChildren "        . "FROM coverage AS m1 LEFT JOIN coverage AS m2 ON m1.id=m2.pid "        . "WHERE m1.pid <=> $parentId "        . "GROUP BY m1.id ORDER BY m1.coverageName ASC";
        $req = Yii::app()->db->createCommand($sql);

        $children = $req->queryAll();
        echo str_replace(
            '"hasChildren":"0"',
            '"hasChildren":false',
            CTreeView::saveDataAsJson($children)
        );
        Yii::app()->end();//exit();
    }

    public function actionIndex(){
        echo $this->id;
        $this->render('index');
    }
}






























