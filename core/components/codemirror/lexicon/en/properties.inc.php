<?php
/**
 * English lexicon for properties
 *
 * @package codemirror
 * @subpackage build
 */
$_lang['prop_cm.classic'] = 'Classic';
$_lang['prop_cm.browser_default'] = 'Browser Default';
$_lang['prop_cm.electricChars_desc'] = 'Configures whether the editor should re-indent the current line when a character is typed that might change its proper indentation (only works if the mode supports indentation).';
$_lang['prop_cm.enterMode_desc'] = 'Determines whether and how new lines are indented when the enter key is pressed. "Indent" uses the indentation rules to give the new line the correct indentation. "Keep" indents the line the same as the previous line. "Flat" does not indent the new line.';
$_lang['prop_cm.firstLineNumber_desc'] = 'At which number to start counting lines.';
$_lang['prop_cm.highlightLine_desc'] = 'Highlight the currently active line.';
$_lang['prop_cm.indent'] = 'Indent';
$_lang['prop_cm.indentUnit_desc'] = 'The number of spaces to use for indentation.';
$_lang['prop_cm.indentWithTabs_desc'] = 'Whether or not to indent when using the tab key.';
$_lang['prop_cm.lineNumbers_desc'] = 'Whether or not to display line numbers.';
$_lang['prop_cm.matchBrackets_desc'] = 'Determines whether brackets are matched whenever the cursor is moved next to a bracket.';
$_lang['prop_cm.shift'] = 'Shift';
$_lang['prop_cm.showSearchForm_desc'] = 'Show the search/replace form.';
$_lang['prop_cm.tabMode_desc'] = 'Determines what happens when the user presses the tab key. <br />Classic: When nothing is selected, insert a tab. Otherwise, behave like the "shift" mode. (When shift is held, this behaves like the "indent" mode.)<br />Shift: Indent all selected lines by one indentUnit. If shift was held while pressing tab, un-indent all selected lines one unit.<br />Indent: Indent the line the *correctly*, based on its syntactic context.<br />Do not capture tab presses, let the browser apply its default behaviour (which usually means it skips to the next control).';
$_lang['prop_cm.undoDepth_desc'] = 'The maximum number of undo levels that the editor stores.';