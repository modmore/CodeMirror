<?php
/**
 * @package tinymce
 * @subpackage build
 */
$events = array();

$evs = array(
    'OnChunkFormPrerender',
    'OnPluginFormPrerender',
    'OnSnipFormPrerender',
    'OnTempFormPrerender',
    //'OnRichTextEditorRegister',
    //'OnRichTextEditorInit',
    //'OnRichTextBrowserInit',
);

foreach ($evs as $ev) {
    $events[$ev] = $modx->newObject('modPluginEvent');
    $events[$ev]->fromArray(array(
        'event' => $ev,
        'priority' => 0,
        'propertyset' => 0,
    ));
}

return $events;