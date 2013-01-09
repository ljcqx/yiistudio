<?php
/**
 * Created by JetBrains PhpStorm.
 * Author: <ljc6qx@gmail.com>
 * Date: 2012.12.01
 * Time: 23:16
 * version: $Id$
 * FileName: ${NAME}
 */
?>
<?php if (Yii::app()->user->hasFlash('success')): ?>
<div class="info">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<h1>Image Upload</h1>

<div class="form">
    <?php echo $form; ?>
</div>