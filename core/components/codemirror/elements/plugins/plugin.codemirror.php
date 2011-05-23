<?php
/**
 * @package codemirror
 */
if ($modx->event->name == 'OnRichTextEditorRegister') {
    $modx->event->output('CodeMirror');
    return;
}
if ($modx->getOption('which_element_editor',null,'CodeMirror') != 'CodeMirror') return;
if (!$modx->getOption('use_editor',null,true)) return;
if (!$modx->getOption('codemirror.enable',null,true)) return;

$assetsUrl = $modx->getOption('codemirror.assets_url',$scriptProperties,$modx->getOption('assets_url').'components/codemirror/');

$options = array(
    'modx_path' => $assetsUrl,
    'modx_delay' => $modx->getOption('loader_delay',$scriptProperties,300),
    'lineNumbers' => (boolean)$modx->getOption('line_numbers',$scriptProperties,true),
    'textWrapping' => (boolean)$modx->getOption('soft_wrap',$scriptProperties,true),
    'tabMode' => $modx->getOption('tab_mode',$scriptProperties,'shift'),
    'indentUnit' => (int)$modx->getOption('indent_unit',$scriptProperties,2),
    'matchBrackets' => (boolean)$modx->getOption('match_brackets',$scriptProperties,true),
);

$load = false;
switch ($modx->event->name) {
    case 'OnSnipFormPrerender':
        $options['modx_loader'] = 'onSnippet';
        $options['mode'] = 'php';
        $load = true;
        break;
    case 'OnTempFormPrerender':
        $options['modx_loader'] = 'onTemplate';
        $options['mode'] = 'htmlmixed';
        $load = true;
        break;
    case 'OnChunkFormPrerender':
        $options['modx_loader'] = 'onChunk';
        $options['mode'] = 'htmlmixed';
        $load = true;
        break;
    case 'OnPluginFormPrerender':
        $options['modx_loader'] = 'onPlugin';
        $options['mode'] = 'php';
        $load = true;
        break;
    /* disabling TVs for now, since it causes problems with newlines
    case 'OnTVFormPrerender':
        $options['modx_loader'] = 'onTV';
        $options['height'] = '250px';
        $load = true;
        break;*/
    case 'OnFileEditFormPrerender':
        $options['modx_loader'] = 'onFile';
        $options['mode'] = 'htmlmixed';
        $load = true;
        break;
    /* debated whether or not to use */
    case 'OnRichTextEditorInit':
        break;
    case 'OnRichTextBrowserInit':
        break;
}

if ($load) {
    $modx->regClientCSS($assetsUrl.'cm/lib/codemirror.css');
    $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
    $modx->regClientStartupScript($assetsUrl.'cm/lib/codemirror.js');

    $modx->regClientStartupScript($assetsUrl.'cm/mode/javascript/javascript.js');
    $modx->regClientCSS($assetsUrl.'cm/mode/javascript/javascript.css');
    $modx->regClientStartupScript($assetsUrl.'cm/mode/css/css.js');
    $modx->regClientCSS($assetsUrl.'cm/mode/css/css.css');

    $modx->regClientStartupScript($assetsUrl.'cm/mode/xml/xml.js');
    $modx->regClientCSS($assetsUrl.'cm/mode/xml/xml.css');
    $modx->regClientStartupScript($assetsUrl.'cm/mode/clike/clike.js');
    $modx->regClientCSS($assetsUrl.'cm/mode/clike/clike.css');
    $modx->regClientStartupScript($assetsUrl.'cm/mode/diff/diff.js');
    $modx->regClientCSS($assetsUrl.'cm/mode/diff/diff.css');
    $modx->regClientStartupScript($assetsUrl.'cm/mode/php/php.js');
    $modx->regClientStartupScript($assetsUrl.'cm/mode/htmlmixed/htmlmixed.js');

    $modx->regClientStartupScript($assetsUrl.'js/cm.js');
}

return;