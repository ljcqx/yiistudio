<?php
/**
 * Created by JetBrains PhpStorm.
 * Author: <ljc6qx@gmail.com>
 * Date: 2012.12.01
 * Time: 23:17
 * version: $Id$
 * FileName: ${NAME}
 */
return array(
    'title' => 'Upload your image',

    'attributes' => array(
        'enctype' => 'multipart/form-data',
    ),

    'elements' => array(
        'image' => array(
            'type' => 'file',
        ),
    ),

    'buttons' => array(
        'reset' => array(
            'type' => 'reset',
            'label' => 'Reset',
        ),
        'submit' => array(
            'type' => 'submit',
            'label' => 'Upload',
        ),
    ),
);