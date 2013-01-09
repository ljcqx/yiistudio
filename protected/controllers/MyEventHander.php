<?php
/**
 * @Filename: MyEventHander.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012-12-20 17:08
 * 实现config/main.php中的message组件中的句柄
 */
class MyEventHander
{
    static function handleMissingTranslation($event)
    {
        //这个事件的事件类是 CMissingTranslationEvent
        // 因此我们能获得这个message的一些信息
        $text = implode("\n", array(
            'Language: '.$event->language,
            'Category:'.$event->category,
            'Message:'.$event->message
        ));
        // 发送邮件
        mail('admin@example.com', 'Missing translation', $text);
    }
}
