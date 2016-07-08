<?php
/**
 * @package codemirror
 * @subpackage build
 */
$settingSource = array(
    'enable' => array(
        'value' => true,
        'area' => 'Editor',
    ),
    'theme' => array(
        'value' => 'default',
        'area' => 'Editor',
    ),
    'indentUnit' => array(
        'value' => 2,
        'area' => 'Editor',
    ),
    'smartIndent' => array(
        'value' => false,
        'area' => 'Editor',
    ),
    'tabSize' => array(
        'value' => 4,
        'area' => 'Editor',
    ),
    'indentWithTabs' => array(
        'value' => true,
        'area' => 'Editor',
    ),
    'electricChars' => array(
        'value' => true,
        'area' => 'Editor',
    ),
    'autoClearEmptyLines' => array(
        'value' => false,
        'area' => 'Editor',
    ),
    'lineWrapping' => array(
        'value' => true,
        'area' => 'Editor',
    ),
    'lineNumbers' => array(
        'value' => true,
        'area' => 'Editor',
    ),
    'firstLineNumber' => array(
        'value' => 1,
        'area' => 'Editor',
    ),
    'highlightLine' => array(
        'value' => true,
        'area' => 'Editor',
    ),
    'matchBrackets' => array(
        'value' => true,
        'area' => 'Editor',
    ),
    'showSearchForm' => array(
        'value' => true,
        'area' => 'Editor',
    ),
    'undoDepth' => array(
        'value' => 40,
        'area' => 'Editor',
    ),
    'fontSize' => array(
        'value' => '13px',
        'area' => 'Editor',
    ),
);

$settings = array();

/**
 * Loop over setting stuff to interpret the xtype and to create the modSystemSetting object for the package.
 */
foreach ($settingSource as $key => $options) {
    $val = $options['value'];

    if (isset($options['xtype'])) $xtype = $options['xtype'];
    elseif (is_int($val)) $xtype = 'numberfield';
    elseif (is_bool($val)) $xtype = 'modx-combo-boolean';
    else $xtype = 'textfield';

    /** @var modSystemSetting */
    $settings[$key] = $modx->newObject('modSystemSetting');
    $settings[$key]->fromArray(array(
        'key' => 'codemirror.' . $key,
        'xtype' => $xtype,
        'value' => $options['value'],
        'namespace' => 'codemirror',
        'area' => $options['area'],
        'editedon' => time(),
    ), '', true, true);
}



return $settings;
