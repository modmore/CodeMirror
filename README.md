# CodeMirror for MODX

CodeMirror for MODX&nbsp;Revolution was previously maintained at splittingred/CodeMirror but has since been adopted by JP&nbsp;DeVries of&nbsp;mod<b>more</b>.

## Installation
Install Codemirror via the [MODX&nbsp;Package&nbsp;Manager](http://modx.com/extras/package/codemirror).

## Configuration
CodeMirror is configurable through the Properties tab of the CodeMirror Plugin as well as System Settings. For backwards compabitility, CodeMirror will first look at the Properties tab of the CodeMirror Plugin and then if needed fallback to the corresponding System&nbsp;Setting.  
System Settings have the advantage of being overriden on the user level. This allows you to set different themes or font sizes for different users. If you'd like CodeMirror to priotize System (or user) Settings over Properties simply delete the given property in the Properties tab or set it's value to the corresponding System Setting eg:&nbsp;`[[++codemirror.fontSize]]`.

| Setting  | Description | Default |
| ------------- | ------------- | ------------- |
| autoClearEmptyLines  | When turned on (default is off), this will clear automatically clear lines consisting only of whitespace when the cursor leaves them. This is mostly useful to prevent auto indentation from introducing trailing whitespace in a file  | `false`
| electricChars  | Configures whether the editor should re-indent the current line when a character is typed that might change its proper indentation (only works if the mode supports indentation)  | `true`
| firstLineNumber  | At which number to start counting lines  | `1`
| fontSize  | Font Size to set the editor to  | `13px`
| highlightLine  | Highlight the currently active line  | `true`
| indentUnit  | The number of spaces to use for indentation  | `false`
| indentWithTabs  | Whether or not to indent when using the tab key  | `true`
| lineNumbers  | Whether or not to display line numbers  | `true`
| lineWrapping  | Whether CodeMirror should scroll or wrap for long lines  | `true`
| matchBrackets  | Determines whether brackets are matched whenever the cursor is moved next to a bracket  | `true`
| showSearchForm  | Show the search/replace form  | `true`
| smartIndent  | Whether to use the context-sensitive indentation (or just indent the same as the line before)  | `false`
| tabSize  | The width of a tab character. Defaults to 4.  | `4`
| theme  | The theme to style the editor with  | `default`
| undoDepth  | The maximum number of undo levels that the editor stores  | `40`
