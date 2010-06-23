<?php
/**
 * @package codemirror
 * @subpackage build
 */
$settings = array();

$settings['codemirror.enable']= $modx->newObject('modSystemSetting');
$settings['codemirror.enable']->fromArray(array(
    'key' => 'codemirror.enable',
    'value' => 1,
    'xtype' => 'combo-boolean',
    'namespace' => 'codemirror',
    'area' => 'Editor',
),'',true,true);

return $settings;