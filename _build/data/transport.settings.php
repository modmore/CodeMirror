<?php
/**
 * @package codemirror
 * @subpackage build
 */
$settings = array();

$settings['codem.enable']= $modx->newObject('modSystemSetting');
$settings['codem.enable']->fromArray(array(
    'key' => 'codem.enable',
    'value' => 1,
    'xtype' => 'combo-boolean',
    'namespace' => 'codemirror',
    'area' => 'Editor',
),'',true,true);

return $settings;