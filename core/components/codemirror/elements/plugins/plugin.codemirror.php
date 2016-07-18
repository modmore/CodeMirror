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
    'theme' => $modx->getOption('theme',$scriptProperties,$modx->getOption('codemirror.theme',null,'default')),
    'indentUnit' => (int)$modx->getOption('indentUnit',$scriptProperties,$modx->getOption('codemirror.indentUnit',null,2)),
    'smartIndent' => (boolean)$modx->getOption('smartIndent',$scriptProperties,$modx->getOption('codemirror.smartIndent',null,false)),
    'tabSize' => (int)$modx->getOption('tabSize',$scriptProperties,$modx->getOption('codemirror.tabSize',null,4)),
    'indentWithTabs' => (boolean)$modx->getOption('indentWithTabs',$scriptProperties,$modx->getOption('codemirror.indentWithTabs',null,true)),
    'electricChars' => (boolean)$modx->getOption('electricChars',$scriptProperties,$modx->getOption('codemirror.electricChars',null,true)),
    'autoClearEmptyLines' => (boolean)$modx->getOption('autoClearEmptyLines',$scriptProperties,$modx->getOption('codemirror.autoClearEmptyLines',null,false)),

    'lineWrapping' => (boolean)$modx->getOption('lineWrapping',$scriptProperties,$modx->getOption('codemirror.lineWrapping',null,true)),
    'lineNumbers' => (boolean)$modx->getOption('lineNumbers',$scriptProperties,$modx->getOption('codemirror.lineNumbers',$scriptProperties,true)),
    'firstLineNumber' => (int)$modx->getOption('firstLineNumber',$scriptProperties,$modx->getOption('codemirror.firstLineNumber',null,1)),
    'highlightLine' => (boolean)$modx->getOption('highlightLine',$scriptProperties,$modx->getOption('codemirror.highlightLine',null,true)),
    'matchBrackets' => (boolean)$modx->getOption('matchBrackets',$scriptProperties,$modx->getOption('codemirror.matchBrackets',null,true)),
    'showSearchForm' => (boolean)$modx->getOption('showSearchForm',$scriptProperties,$modx->getOption('codemirror.showSearchForm',null,true)),
    'undoDepth' => $modx->getOption('undoDepth',$scriptProperties,$modx->getOption('codemirror.undoDepth',null,40)),
    'fontSize' => $modx->getOption('fontSize',$scriptProperties,$modx->getOption('codemirror.fontSize',null,'13px'))
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
    
    //$modx->regClientCSS($codeMirror->config['assetsUrl'].'css/codemirror.css');
    $modx->regClientCSS('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/codemirror.min.css');
    //$modx->regClientCSS($codeMirror->config['assetsUrl'].'css/cm.css');
    //$modx->regClientCSS($codeMirror->config['assetsUrl'].'css/cm.css');
    //if ($options['theme'] != 'default') {
    //    $modx->regClientCSS($codeMirror->config['assetsUrl'].'cm/theme/'.$options['theme'].'.css');
    //}
    //$modx->regClientStartupScript($codeMirror->config['assetsUrl'].'js/codemirror-compressed.js');
    //$modx->regClientStartupScript($codeMirror->config['assetsUrl'].'js/cm.js');
    $modx->regClientStartupScript('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/codemirror.min.js');

    $modx->regClientStartupScript('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/xml/xml.min.js');
    $modx->regClientStartupScript('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/htmlmixed/htmlmixed.min.js');
    $modx->regClientStartupScript('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/clike/clike.min.js');
    $modx->regClientStartupScript('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/javascript/javascript.min.js');
	$modx->regClientStartupScript('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/css/css.min.js');
    $modx->regClientStartupScript('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/php/php.min.js');
    $modx->regClientStartupScript('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/addon/edit/matchbrackets.min.js');
    $modx->regClientStartupScript($codeMirror->config['assetsUrl'].'js/cm.js');
    $fontSize = $options['fontSize'];
    if(!empty($fontSize)) $modx->regClientStartupHTMLBlock("<style>.CodeMirror { font-size:$fontSize; }</style>");
}

return;