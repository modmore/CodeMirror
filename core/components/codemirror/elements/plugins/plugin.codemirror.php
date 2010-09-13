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
);

$load = false;
switch ($modx->event->name) {
    case 'OnSnipFormPrerender':
        $options['modx_loader'] = 'onSnippet';
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/cm.js');
        break;
    case 'OnTempFormPrerender':
        $options['modx_loader'] = 'onTemplate';
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/cm.js');
        break;
    case 'OnChunkFormPrerender':
        $options['modx_loader'] = 'onChunk';
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/cm.js');
        break;
    case 'OnPluginFormPrerender':
        $options['modx_loader'] = 'onPlugin';
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/cm.js');
        break;
    /* disabling TVs for now, since it causes problems with newlines
    case 'OnTVFormPrerender':
        $options['modx_loader'] = 'onTV';
        $options['height'] = '250px';
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/cm.js');
        break;*/
    case 'OnFileEditFormPrerender':
        $options['modx_loader'] = 'onFile';
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codem = '.$modx->toJSON($options).';</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/cm.js');
        break;
    /* debated whether or not to use */
    case 'OnRichTextEditorInit':
        break;
    case 'OnRichTextBrowserInit':
        break;
}

return;