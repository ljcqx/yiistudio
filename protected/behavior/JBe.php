<?php
/**
 * @Filename: JBe.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012.12.26 14:22
 */
class JBe extends CBehavior
{
    public function get100width(){
        return $this->Owner->width*100;
    }
}
