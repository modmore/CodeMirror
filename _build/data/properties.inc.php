<?php
/**
 * A default list of properties for the plugin
 *
 * @package codemirror
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'indentUnit',
        'desc' => 'prop_cm.indentUnit_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 2,
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'indentWithTabs',
        'desc' => 'prop_cm.indentWithTabs_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'tabMode',
        'desc' => 'prop_cm.tabMode_desc',
        'type' => 'list',
        'options' => array(
            array('text' => 'prop_cm.classic', 'value' => 'classic'),
            array('text' => 'prop_cm.shift', 'value' => 'shift'),
            array('text' => 'prop_cm.indent', 'value' => 'indent'),
            array('text' => 'prop_cm.browser_default', 'value' => 'default'),
        ),
        'value' => 'classic',
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'enterMode',
        'desc' => 'prop_cm.enterMode_desc',
        'type' => 'list',
        'options' => array(
            array('text' => 'prop_cm.indent', 'value' => 'indent'),
            array('text' => 'prop_cm.keep', 'value' => 'keep'),
            array('text' => 'prop_cm.flat', 'value' => 'flat'),
        ),
        'value' => 'indent',
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'electricChars',
        'desc' => 'prop_cm.electricChars_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'lineNumbers',
        'desc' => 'prop_cm.lineNumbers_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'firstLineNumber',
        'desc' => 'prop_cm.firstLineNumber_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 1,
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'highlightLine',
        'desc' => 'prop_cm.highlightLine_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'matchBrackets',
        'desc' => 'prop_cm.matchBrackets_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'showSearchForm',
        'desc' => 'prop_cm.showSearchForm_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
        'lexicon' => 'codemirror:properties',
    ),
    array(
        'name' => 'undoDepth',
        'desc' => 'prop_cm.undoDepth_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 40,
        'lexicon' => 'codemirror:properties',
    ),
);

return $properties;
