<?php
//woker example

function reverse($job){
    return strrev($job->workload());
}

Yii::app()->gearman->client()->doBackground("reverse", array($this, 'reverse'));
while($woker->work()){
    echo "Done!";
}
