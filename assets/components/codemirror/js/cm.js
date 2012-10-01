if(!Ext){Ext = {};}if(!MODx){var MODx={codem:{}};}

var Codem = function() {
    return {
        init: function(fld,panel) {
            if (Codem.rteInitialized) return false;
            Codem.id = fld;
            Codem.foldFunc = CodeMirror.newFoldFunction(CodeMirror.tagRangeFinder)

            var cp = MODx.codem.modx_path+'cm/';
            Ext.applyIf(MODx.codem,{
                onChange: function(ed) {
                    if (!ed) return;
                    Ext.getCmp(panel).markDirty();
                }

                ,syntax: 'html'
                ,profile: 'xhtml'
                ,lineWrapping: true
                ,onGutterClick:Codem.foldFunc
                ,extraKeys: {
                    "Ctrl-Q": function(cm){Codem.foldFunc(cm, cm.getCursor().line);}
                    ,"F6": function(cm) {
                      Codem.setFullScreen(cm, !Codem.isFullScreen(cm));
                    }
                    ,"Esc": function(cm) {
                      if (Codem.isFullScreen(cm)) Codem.setFullScreen(cm, false);
                    }

                }
            });

            MODx.codem.onCursorActivity = function() {
                MODx.editor.matchHighlight("CodeMirror-matchhighlight");
                if (MODx.codem.highlightLine) {
                    MODx.editor.setLineClass(MODx.hlLine, null, null);
                    MODx.hlLine = MODx.editor.setLineClass(MODx.editor.getCursor().line,null,"activeline");
                }
            };
            CodeMirror.connect(Ext.getDoc().dom, "resize", function() {
              var showing = Ext.getBody().dom.getElementsByClassName("CodeMirror-fullscreen")[0];
              if (!showing) return;
              showing.CodeMirror.getScrollerElement().style.height = Codem.winHeight() + "px";
            });
            fld = Ext.get(fld);
            MODx.editor = CodeMirror.fromTextArea(fld.dom,MODx.codem);

            if (MODx.codem.highlightLine) {
                MODx.hlLine = MODx.editor.setLineClass(0, "activeline");
            }
            MODx.editor.field = fld;
            
            MODx.onSaveEditor = function(fld) {
                var v = MODx.editor.getValue();
                fld.setValue(v);
            };
            Codem.rteInitialized = true;
            if (MODx.codem.searchTpl && MODx.codem.showSearchForm) {
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
        ,onResource: function() {
            return Codem.init('ta','modx-panel-resource');
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

        ,isFullScreen: function(cm) {
          return /\bCodeMirror-fullscreen\b/.test(cm.getWrapperElement().className);
        }
        ,winHeight: function() {
          return window.innerHeight || (document.documentElement || document.body).clientHeight;
        }
        ,setFullScreen: function(cm, full) {
          var wrap = cm.getWrapperElement(), scroll = cm.getScrollerElement();
          if (full) {
            wrap.className += " CodeMirror-fullscreen";
            scroll.style.height = Codem.winHeight() + "px";
            document.documentElement.style.overflow = "hidden";
          } else {
            wrap.className = wrap.className.replace(" CodeMirror-fullscreen", "");
            scroll.style.height = "";
            document.documentElement.style.overflow = "";
          }
          cm.refresh();
        }
    };
}();

Ext.onReady(function() {
    MODx.onLoadEditor = Codem[MODx.codem.modx_loader];
    MODx.onLoadEditor();
});