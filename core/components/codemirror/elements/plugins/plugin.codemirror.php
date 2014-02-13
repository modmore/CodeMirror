<?php
/**
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package codemirror
 */
if ($modx->event->name == 'OnRichTextEditorRegister') {
    $modx->event->output('CodeMirror');
    return;
}

$eventArray = array(
    'element'=>array(
		'OnSnipFormPrerender',
		'OnTempFormPrerender',
		'OnChunkFormPrerender',
		'OnPluginFormPrerender',
		/*'OnTVFormPrerender'*/
		'OnFileEditFormPrerender',
		'OnFileEditFormPrerender',
		),
	'other'=>array(
		'OnDocFormPrerender',
		'OnRichTextEditorInit',
		'OnRichTextBrowserInit'
	)
);
if ((in_array($modx->event->name,$eventArray['element']) && $modx->getOption('which_element_editor',null,'CodeMirror') != 'CodeMirror') || (in_array($modx->event->name,$eventArray['other']) && $modx->getOption('which_editor',null,'CodeMirror') != 'CodeMirror')) return;

if (!$modx->getOption('use_editor',null,true)) return;
if (!$modx->getOption('codemirror.enable',null,true)) return;

/** @var CodeMirror $codeMirror */
$codeMirror = $modx->getService('codemirror','CodeMirror',$modx->getOption('codemirror.core_path',null,$modx->getOption('core_path').'components/codemirror/').'model/codemirror/');
if (!($codeMirror instanceof CodeMirror)) return '';

$options = array(
    'modx_path' => $codeMirror->config['assetsUrl'],
    'theme' => $modx->getOption('theme',$scriptProperties,'default'),

    'indentUnit' => (int)$modx->getOption('indentUnit',$scriptProperties,$modx->getOption('indent_unit',$scriptProperties,2)),
    'smartIndent' => (boolean)$modx->getOption('smartIndent',$scriptProperties,false),
    'tabSize' => (int)$modx->getOption('tabSize',$scriptProperties,4),
    'indentWithTabs' => (boolean)$modx->getOption('indentWithTabs',$scriptProperties,true),
    'electricChars' => (boolean)$modx->getOption('electricChars',$scriptProperties,true),
    'autoClearEmptyLines' => (boolean)$modx->getOption('electricChars',$scriptProperties,false),

    'lineWrapping' => (boolean)$modx->getOption('lineWrapping',$scriptProperties,true),
    'lineNumbers' => (boolean)$modx->getOption('lineNumbers',$scriptProperties,$modx->getOption('line_numbers',$scriptProperties,true)),
    'firstLineNumber' => (int)$modx->getOption('firstLineNumber',$scriptProperties,1),
    'highlightLine' => (boolean)$modx->getOption('highlightLine',$scriptProperties,true),
    'matchBrackets' => (boolean)$modx->getOption('matchBrackets',$scriptProperties,true),
    'showSearchForm' => (boolean)$modx->getOption('showSearchForm',$scriptProperties,true),
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
    case 'OnDocFormPrerender':
    	$options['modx_loader'] = 'onResource';
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
    $options['searchTpl'] = $codeMirror->getChunk('codemirror.search');

    $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
    $modx->regClientCSS($codeMirror->config['assetsUrl'].'css/codemirror-compressed.css');
    $modx->regClientCSS($codeMirror->config['assetsUrl'].'css/cm.css');
    if ($options['theme'] != 'default') {
        $modx->regClientCSS($codeMirror->config['assetsUrl'].'cm/theme/'.$options['theme'].'.css');
    }
    $modx->regClientStartupScript($codeMirror->config['assetsUrl'].'js/codemirror-compressed.js');
    $modx->regClientStartupScript($codeMirror->config['assetsUrl'].'js/cm.js');
}

return;
