var Codem = function() {
    return {
        init: function(fld,panel) {
            if (Codem.rteInitialized) return false;

            var cp = MODx.codem.modx_path+'cm/';
            var opt = MODx.codem;
            Ext.applyIf(opt,{
                onChange: function(ed) {
                    if (!ed) return;
                    Ext.getCmp(panel).markDirty();
                }

                // Zen Coding stuff
                ,syntax: 'html'
                ,profile: 'xhtml'
            });
            fld = Ext.get(fld);
            MODx.editor = CodeMirror.fromTextArea(fld.dom,opt);
            MODx.editor.field = fld;
            if (zen_editor) {
                zen_editor.bind(MODx.editor);
            }
            MODx.onSaveEditor = function(fld) {
                var v = MODx.editor.getValue();
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
    MODx.onLoadEditor();
});