<?php
/**
 * @Filename: MyTest.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2013.01.08 16:16
 * 1、根据YII的约定，CMD窗口命令通常为 webapp\protected\tests> phpunit unit\xxxTest.php，否则会报错；
 * 2、测试方法以test开头 public function testYourfunction(){} … ；
 */
class MyTest extends CTestCase{
    public function testMyfunction(){
        echo 'hello';
    }
}