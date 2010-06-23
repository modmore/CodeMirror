MODx.onLoadEditor = function() {
    if (MODx.rteInitialized) return false;

    var cp = MODx.config['codem.assets_url']+'cm/';

    MODx.editor = CodeMirror.fromTextArea('modx-plugin-plugincode', {
        parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js",
                     "../contrib/php/js/tokenizephp.js", "../contrib/php/js/parsephp.js",
                     "../contrib/php/js/parsephphtmlmixed.js"]
        ,stylesheet: [cp+'css/xmlcolors.css',cp+'css/jscolors.css',cp+ 'css/csscolors.css', cp+'contrib/php/css/phpcolors.css']
        ,path: cp+"js/"
        ,continuousScanning: 250
        ,lineNumbers: true
        ,onChange: function() {
            Ext.getCmp('modx-panel-plugin').markDirty();
            Ext.getCmp('modx-plugin-plugincode').setValue(MODx.editor.getCode());
        }
    });
    MODx.rteInitialized = true;
    return true;
};
Ext.onReady(function() {
    if (!MODx.request.id) { MODx.onLoadEditor(); }
});