var Codem = function() {
    return {
        init: function(fld,panel) {
            if (Codem.rteInitialized) return false;

            var cp = MODx.codem.modx_path+'cm/';
            var opt = MODx.codem;
            Ext.applyIf(opt,{
                parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js",
                             "../contrib/php/js/tokenizephp.js", "../contrib/php/js/parsephp.js",
                             "../contrib/php/js/parsephphtmlmixed.js"]
                ,stylesheet: [cp+'css/xmlcolors.css',cp+'css/jscolors.css',cp+ 'css/csscolors.css', cp+'contrib/php/css/phpcolors.css']
                ,path: cp+"js/"
                ,continuousScanning: 50
                ,onChange: function() {
                    Ext.getCmp(panel).markDirty();
                    var v = MODx.editor.getCode();
                    if (MODx.editor.field == 'modx-tv-default-text' && v == "\n") {
                        v = '';
                    }
                    Ext.getCmp(fld).setValue(v);
                }
            });
            MODx.editor = CodeMirror.fromTextArea(fld,opt);
            MODx.editor.field = fld;
            MODx.onSaveEditor = function(fld) {
                var v = MODx.editor.getCode();
                fld.setValue(v);
            };
            Codem.rteInitialized = true;
            return true;
        }

        ,onChunk: function() {
            return Codem.init('modx-chunk-snippet','modx-panel-chunk');
        }
        ,onPlugin: function() {
            return Codem.init('modx-plugin-plugincode','modx-panel-plugin');
        }
        ,onSnippet: function() {
            return Codem.init('modx-snippet-snippet','modx-panel-snippet');
        }
        ,onTemplate: function() {
            return Codem.init('modx-template-content','modx-panel-template');
        }
        ,onTV: function() {
            return Codem.init('modx-tv-default-text','modx-panel-tv');
        }
        ,onFile: function() {
            return Codem.init('modx-file-content','modx-panel-file-edit');
        }
    };
}();

Ext.onReady(function() {
    MODx.onLoadEditor = Codem[MODx.codem.modx_loader];
    if (!MODx.request.id) { 
        setTimeout("MODx.onLoadEditor();",MODx.codem.modx_delay);
    }
});