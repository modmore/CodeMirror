<?php
/**
 * @package codemirror
 */
/*
if ($modx->event->name == 'OnRichTextEditorRegister') {
    $modx->event->output('CodeMirror');
    return;
}*/
/* debatable whether or not which_editor should determine CodeMirror, since its not a Resource editor
 * Need to come up with a backup solution for this in Revo core. */

//if ($modx->getOption('which_editor',null,false) != 'CodeMirror') return;
if (!$modx->getOption('use_editor',null,true)) return;
if (!$modx->getOption('codem.enable',null,true)) return;

$assetsUrl = $modx->getOption('codem.assets_url',$scriptProperties,$modx->getOption('assets_url').'components/codemirror/');

switch ($modx->event->name) {
    case 'OnSnipFormPrerender':
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codemPath = "'.$assetsUrl.'";</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/forms/snippet.js');
        break;
    case 'OnTempFormPrerender':
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codemPath = "'.$assetsUrl.'";</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/forms/template.js');
        break;
    case 'OnChunkFormPrerender':
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codemPath = "'.$assetsUrl.'";</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/forms/chunk.js');
        break;
    case 'OnPluginFormPrerender':
        $modx->regClientCSS($assetsUrl.'css/cm.css');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">MODx.codemPath = "'.$assetsUrl.'";</script>');
        $modx->regClientStartupScript($assetsUrl.'cm/js/codemirror.js');
        $modx->regClientStartupScript($assetsUrl.'js/forms/plugin.js');
        break;
    /* debated whether or not to use */
    case 'OnRichTextEditorInit':
        break;
    case 'OnRichTextBrowserInit':
        break;
}
return;