<?php
//Client Example
Yii::app()->gearman->client()->doBackground("reverse", "Hello World!");