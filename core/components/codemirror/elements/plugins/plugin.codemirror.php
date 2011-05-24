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

$codeMirror = $modx->getService('codemirror','CodeMirror',$modx->getOption('codemirror.core_path',null,$modx->getOption('core_path').'components/codemirror/').'model/codemirror/');
if (!($codeMirror instanceof CodeMirror)) return '';


$options = array(
    'modx_path' => $codeMirror->config['assetsUrl'],
    'electricChars' => (boolean)$modx->getOption('electricChars',$scriptProperties,true),
    'enterMode' => $modx->getOption('tabMode',$scriptProperties,'indent'),
    'firstLineNumber' => (int)$modx->getOption('firstLineNumber',$scriptProperties,1),
    'highlightLine' => (boolean)$modx->getOption('highlightLine',$scriptProperties,true),
    'indentUnit' => (int)$modx->getOption('indentUnit',$scriptProperties,$modx->getOption('indent_unit',$scriptProperties,2)),
    'indentWithTabs' => (boolean)$modx->getOption('indentWithTabs',$scriptProperties,true),
    'lineNumbers' => (boolean)$modx->getOption('lineNumbers',$scriptProperties,$modx->getOption('line_numbers',$scriptProperties,true)),
    'matchBrackets' => (boolean)$modx->getOption('matchBrackets',$scriptProperties,true),
    'showSearchForm' => (boolean)$modx->getOption('showSearchForm',$scriptProperties,true),
    'tabMode' => $modx->getOption('tabMode',$scriptProperties,$modx->getOption('tab_mode',$scriptProperties,'classic')),
    'undoDepth' => $modx->getOption('undoDepth',$scriptProperties,40),
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
        $options['mode'] = 'php';
        $load = true;
        break;
    /* debated whether or not to use */
    case 'OnRichTextEditorInit':
        break;
    case 'OnRichTextBrowserInit':
        break;
}

if ($load) {
    $options['searchTpl'] = $codeMirror->getChunk('search');

    $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
    $modx->regClientCSS($codeMirror->config['assetsUrl'].'css/codemirror-compressed.css');
    $modx->regClientCSS($codeMirror->config['assetsUrl'].'css/cm.css');
    $modx->regClientStartupScript($codeMirror->config['assetsUrl'].'js/codemirror-compressed.js');
    $modx->regClientStartupScript($codeMirror->config['assetsUrl'].'js/cm.js');
}

return;