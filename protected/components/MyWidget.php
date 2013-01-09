<?php
/**
 * @Filename: MyWidget.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012.12.28 13:18
 */
//继承 CWidget 并覆盖其init()和run()方法,可以定义一个新的小物件:

class MyWidget extends CWidget
{
    public function init()
    {
        //此方法会被CController::beginWidget()调用
    }
    public function run()
    {
        //此方法会被CController::endWidget()调用
    }
}
