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

switch ($modx->event->name) {
    case 'OnSnipFormPrerender':
        $modx->regClientCSS($modx->getOption('codem.assets_url').'css/cm.css');
        $modx->regClientStartupScript($modx->getOption('codem.assets_url').'cm/js/codemirror.js');
        $modx->regClientStartupScript($modx->getOption('codem.assets_url').'js/forms/snippet.js');
        break;
    case 'OnTempFormPrerender':
        $modx->regClientCSS($modx->getOption('codem.assets_url').'css/cm.css');
        $modx->regClientStartupScript($modx->getOption('codem.assets_url').'cm/js/codemirror.js');
        $modx->regClientStartupScript($modx->getOption('codem.assets_url').'js/forms/template.js');
        break;
    case 'OnChunkFormPrerender':
        $modx->regClientCSS($modx->getOption('codem.assets_url').'css/cm.css');
        $modx->regClientStartupScript($modx->getOption('codem.assets_url').'cm/js/codemirror.js');
        $modx->regClientStartupScript($modx->getOption('codem.assets_url').'js/forms/chunk.js');
        break;
    case 'OnPluginFormPrerender':
        $modx->regClientCSS($modx->getOption('codem.assets_url').'css/cm.css');
        $modx->regClientStartupScript($modx->getOption('codem.assets_url').'cm/js/codemirror.js');
        $modx->regClientStartupScript($modx->getOption('codem.assets_url').'js/forms/plugin.js');
        break;
    /* debated whether or not to use */
    case 'OnRichTextEditorInit':
        break;
    case 'OnRichTextBrowserInit':
        break;
}
return;