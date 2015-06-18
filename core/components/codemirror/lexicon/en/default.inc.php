<?php
/**
 * Default Language file for CodeMirror
 *
 * @package codemirror
 * @subpackage lexicon
 */
$_lang['codemirror'] = 'CodeMirror';
$_lang['codemirror.search'] = 'Search';
$_lang['codemirror.replace'] = 'Replace';

$_lang['setting_codem.enable'] = 'Enable CodeMirror';
$_lang['setting_codem.enable_desc'] = 'Set to enable or disable CodeMirror across your manager instance.';

$_lang['setting_codem.theme'] = 'Theme';
$_lang['setting_codem.theme_desc'] = 'The theme to style the editor with. You must make sure the CSS file defining the corresponding .cm-s-[name] styles is loaded (see the theme directory in the distribution).<br>Avaialbe themes are ambiance, blackboard, cobalt, eclipse, elegant, erlang-dark, lesser-dark, monokai, neat, night, rubyblue, twilight, vibrant-ink and xq-dark.';

$_lang['setting_codem.indentUnit'] = 'Indent Unit';
$_lang['setting_codem.indentUnit_desc'] = 'How many spaces a block (whatever that means in the edited language) should be indented. The default is 2.';

$_lang['setting_codem.smartIndent'] = 'Smart Indent';
$_lang['setting_codem.smartIndent_desc'] = 'Whether to use the context-sensitive indentation that the mode provides (or just indent the same as the line before). Defaults to true.';

$_lang['setting_codem.tabSize'] = 'Tab Size';
$_lang['setting_codem.tabSize_desc'] = 'The width of a tab character. Defaults to 4.';

$_lang['setting_codem.indentWithTabs'] = 'Indent With Tabs';
$_lang['setting_codem.indentWithTabs_desc'] = 'Whether, when indenting, the first N*tabSize spaces should be replaced by N tabs. Default is false.';

$_lang['setting_codem.electricChars'] = 'Electric Characters';
$_lang['setting_codem.electricChars_desc'] = 'Configures whether the editor should re-indent the current line when a character is typed that might change its proper indentation (only works if the mode supports indentation). Default is true.';

$_lang['setting_codem.autoClearEmptyLines'] = 'Auto Clear Empty Lines';
$_lang['setting_codem.autoClearEmptyLines_desc'] = 'When turned on (default is off), this will automatically clear lines consisting only of whitespace when the cursor leaves them. This is mostly useful to prevent auto indentation from introducing trailing whitespace in a file.';

$_lang['setting_codem.lineWrapping'] = 'Line Wrapping';
$_lang['setting_codem.lineWrapping_desc'] = 'Whether CodeMirror should scroll or wrap for long lines. Defaults to false (scroll).';

$_lang['setting_codem.lineNumbers'] = 'Line Numbers';
$_lang['setting_codem.lineNumbers_desc'] = 'Whether to show line numbers to the left of the editor.';

$_lang['setting_codem.firstLineNumber'] = 'First Line Number';
$_lang['setting_codem.firstLineNumber_desc'] = 'At which number to start counting lines. Default is 1.';

$_lang['setting_codem.highlightLine'] = 'Highlight Line';
$_lang['setting_codem.highlightLine_desc'] = 'When enabled highlights the current line.';

$_lang['setting_codem.matchBrackets'] = 'Match Brackets';
$_lang['setting_codem.matchBrackets_desc'] = 'Determines whether brackets are matched whenever the cursor is moved next to a bracket.';

$_lang['setting_codem.showSearchForm'] = 'Show Search Form';
$_lang['setting_codem.showSearchForm_desc'] = 'When enabled displays a search form beneath the editor.';

$_lang['setting_codem.undoDepth'] = 'Undo Depth';
$_lang['setting_codem.undoDepth_desc'] = 'The maximum number of undo levels that the editor stores. Defaults to 40.';