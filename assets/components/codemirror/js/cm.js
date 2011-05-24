var Codem = function() {
    return {
        init: function(fld,panel) {
            if (Codem.rteInitialized) return false;
            Codem.id = fld;

            var cp = MODx.codem.modx_path+'cm/';
            var opt = MODx.codem;
            Ext.applyIf(opt,{
                onChange: function(ed) {
                    if (!ed) return;
                    Ext.getCmp(panel).markDirty();
                }

                ,syntax: 'html'
                ,profile: 'xhtml'
            });
            if (opt.highlightLine) {
                opt.onCursorActivity = function() {
                    MODx.editor.setLineClass(MODx.hlLine, null);
                    MODx.hlLine = MODx.editor.setLineClass(MODx.editor.getCursor().line, "activeline");
                };
            }
            fld = Ext.get(fld);
            MODx.editor = CodeMirror.fromTextArea(fld.dom,opt);
            if (opt.highlightLine) {
                MODx.hlLine = MODx.editor.setLineClass(0, "activeline");
            }
            MODx.editor.field = fld;
            
            MODx.onSaveEditor = function(fld) {
                var v = MODx.editor.getValue();
                fld.setValue(v);
            };
            Codem.rteInitialized = true;
            if (MODx.codem.searchTpl && opt.showSearchForm) {
                this.addSearchForm();
            }
            return true;
        }

        ,addSearchForm: function() {
            var below = Ext.get('x-form-el-'+Codem.id);
            below.createChild({
                tag: 'div'
                ,id: 'cm-content-below'
                ,style: 'margin-top: 5px;'
                ,html: MODx.codem.searchTpl
            });
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



        ,lastPos: null
        ,lastQuery: null
        ,marked: []

        ,unmark: function() {
          for (var i = 0; i < Codem.marked.length; ++i) {
              Codem.marked[i]();
          }
          Codem.marked.length = 0;
        }

        ,search: function() {
          Codem.unmark();
          var text = document.getElementById("cm-query").value;
          if (!text) return;
          var cursor = null;
          for (cursor = MODx.editor.getSearchCursor(text); cursor.findNext();)
            Codem.marked.push(MODx.editor.markText(cursor.from(), cursor.to(), "searched"));

          if (Codem.lastQuery != text) {
              Codem.lastPos = null;
          }
          cursor = MODx.editor.getSearchCursor(text, Codem.lastPos || MODx.editor.getCursor());
          if (!cursor.findNext()) {
            cursor = MODx.editor.getSearchCursor(text);
            if (!cursor.findNext()) return;
          }
          MODx.editor.setSelection(cursor.from(), cursor.to());
          Codem.lastQuery = text;
          Codem.lastPos = cursor.to();
        }

        ,replace: function() {
            Codem.unmark();
            var text = document.getElementById("cm-query").value,
            replace = document.getElementById("cm-replace").value;
            if (!text) return;
            for (var cursor = MODx.editor.getSearchCursor(text); cursor.findNext();)
                MODx.editor.replaceRange(replace, cursor.from(), cursor.to());
        }
    };
}();

Ext.onReady(function() {
    MODx.onLoadEditor = Codem[MODx.codem.modx_loader];
    MODx.onLoadEditor();
});