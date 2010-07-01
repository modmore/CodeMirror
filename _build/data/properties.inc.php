<?php
/**
 * A default list of properties for the plugin
 *
 * @package codemirror
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'line_numbers',
        'desc' => 'Whether or not to display line numbers.',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
    ),
    array(
        'name' => 'soft_wrap',
        'desc' => 'Whether or not to soft wrap the text.',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
    ),
    array(
        'name' => 'tab_mode',
        'desc' => 'The effect of pressing tab. Defaults to tab moves text one indent_unit right, shift+tab moves text one indent_unit left.',
        'type' => 'list',
        'options' => array(
            array('text' => 'Shift', 'value' => 'shift'),
            array('text' => 'Indent', 'value' => 'indent'),
            array('text' => '4 Spaces', 'value' => 'spaces'),
            array('text' => 'Browser Default', 'value' => 'default'),
        ),
        'value' => 'shift',
    ),
    array(
        'name' => 'indent_unit',
        'desc' => 'The number of spaces to use for indentation.',
        'type' => 'textfield',
        'options' => '',
        'value' => 2,
    ),
    array(
        'name' => 'loader_delay',
        'desc' => 'The number of milliseconds to wait before loading the RTE on New elements. Make a larger number if you are experiencing loading errors.',
        'type' => 'textfield',
        'options' => '',
        'value' => 300,
    ),
);

return $properties;
