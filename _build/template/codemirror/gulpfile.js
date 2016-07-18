var gulp = require('gulp');
var bower = require('gulp-bower');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var clean = require('gulp-clean');
var runSequence = require('run-sequence');

var config = {
    assetsPath: '../../../assets/components/codemirror/',
    lib: './lib/'
};
 
gulp.task('bower', function () {
  return bower()
    .pipe(gulp.dest('lib/'))
});

gulp.task('copy', function(){
  // no exportsOverrides support for gulp :( https://github.com/zont/gulp-bower/issues/30
  // glob ignoring is a PITA https://github.com/gulpjs/gulp/issues/165
  gulp.src([
      '!' + config.lib + 'codemirror/' + 'bin/',
      '!' + config.lib + 'codemirror/' + 'bin/**/*',
      '!' + config.lib + 'codemirror/' + 'demo/',
      '!' + config.lib + 'codemirror/' + 'demo/**/*',
      '!' + config.lib + 'codemirror/' + 'test/',
      '!' + config.lib + 'codemirror/' + 'test/**/*',
      '!' + config.lib + 'codemirror/' + 'package.json',
      '!' + config.lib + 'codemirror/' + 'CONTRIBUTING.md',
      config.lib + 'codemirror/**/*'
  ])
    .pipe(gulp.dest(config.assetsPath + 'cm/'));
});

// we could glob mode/**/*.js to include them all but this way we can see what's being included and indivudally disable. I'm also not sure if all these really need to be included (vbscript, really?), but they were before so I'm including them so as to not introduce breaking changes
gulp.task('concat', function() {
  return gulp.src([
    config.assetsPath + 'cm/lib/' + 'codemirror.js',
    config.assetsPath + 'cm/mode/clike/' + 'clike.js',
    config.assetsPath + 'cm/mode/clojure/' + 'clojure.js',
    config.assetsPath + 'cm/mode/coffeescript/' + 'coffeescript.js',
    config.assetsPath + 'cm/mode/css/' + 'css.js',
    config.assetsPath + 'cm/mode/gfm/' + 'gfm.js',
    config.assetsPath + 'cm/mode/ecl/' + 'ecl.js',
    config.assetsPath + 'cm/mode/erlang/' + 'erlang.js',
    config.assetsPath + 'cm/mode/markdown/' + 'markdown.js',
    config.assetsPath + 'cm/mode/go/' + 'go.js',
    config.assetsPath + 'cm/mode/groovy/' + 'groovy.js',
    config.assetsPath + 'cm/mode/haskell/' + 'haskell.js',
    config.assetsPath + 'cm/mode/htmlembedded/' + 'htmlembedded.js',
    config.assetsPath + 'cm/mode/htmlmixed/' + 'htmlmixed.js', 
    config.assetsPath + 'cm/mode/javascript/' + 'javascript.js', 
    config.assetsPath + 'cm/mode/jinja2/' + 'jinja2.js', 
    config.assetsPath + 'cm/mode/less/' + 'less.js', 
    config.assetsPath + 'cm/mode/lua/' + 'lua.js',
    config.assetsPath + 'cm/mode/mysql/' + 'mysql.js', 
    config.assetsPath + 'cm/mode/ntriples/' + 'ntriples.js', 
    config.assetsPath + 'cm/mode/pascal/' + 'pascal.js', 
    config.assetsPath + 'cm/mode/perl/' + 'perl.js', 
    config.assetsPath + 'cm/mode/php/' + 'php.js', 
    config.assetsPath + 'cm/mode/pig/' + 'pig.js', 
    config.assetsPath + 'cm/mode/plsql/' + 'plsql.js', 
    config.assetsPath + 'cm/mode/python/' + 'python.js', 
    config.assetsPath + 'cm/mode/rpm/changes/' + 'changes.js', 
    config.assetsPath + 'cm/mode/rpm/spec/' + 'spec.js', 
    config.assetsPath + 'cm/mode/rst/' + 'rst.js',
    config.assetsPath + 'cm/mode/ruby/' + 'ruby.js', 
    config.assetsPath + 'cm/mode/rust/' + 'rust.js', 
    config.assetsPath + 'cm/mode/scheme/' + 'scheme.js', 
    config.assetsPath + 'cm/mode/shell/' + 'shell.js', 
    config.assetsPath + 'cm/mode/smalltalk/' + 'smalltalk.js', 
    config.assetsPath + 'cm/mode/smarty/' + 'smarty.js', 
    config.assetsPath + 'cm/mode/sparql/' + 'sparql.js', 
    config.assetsPath + 'cm/mode/stex/' + 'stex.js', 
    config.assetsPath + 'cm/mode/tiddlywiki/' + 'tiddlywiki.js', 
    config.assetsPath + 'cm/mode/tiki/' + 'tiki.js', 
    config.assetsPath + 'cm/mode/vbscript/' + 'vbscript.js', 
    config.assetsPath + 'cm/mode/velocity/' + 'velocity.js', 
    config.assetsPath + 'cm/mode/verilog/' + 'verilog.js', 
    config.assetsPath + 'cm/mode/xml/' + 'xml.js', 
    config.assetsPath + 'cm/mode/xquery/' + 'xquery.js', 
    config.assetsPath + 'cm/mode/yaml/' + 'yaml.js', 

    config.assetsPath + 'cm/lib/util/' + 'closetag.js',
    config.assetsPath + 'cm/lib/util/' + 'dialog.js',
    config.assetsPath + 'cm/lib/util/' + 'foldcode.js',
    config.assetsPath + 'cm/lib/util/' + 'formatting.js',
    config.assetsPath + 'cm/lib/util/' + 'javascript-hint.js',
    config.assetsPath + 'cm/lib/util/' + 'loadmode.js',
    config.assetsPath + 'cm/lib/util/' + 'match-highlighter.js',
    config.assetsPath + 'cm/lib/util/' + 'multiplex.js',
    config.assetsPath + 'cm/lib/util/' + 'overlay.js',
    config.assetsPath + 'cm/lib/util/' + 'pig-hint.js',
    config.assetsPath + 'cm/lib/util/' + 'runmode.js',
    config.assetsPath + 'cm/lib/util/' + 'search.js',
    config.assetsPath + 'cm/lib/util/' + 'simple-hint.js'
  ])
    .pipe(concat('codemirror.js'))
    .pipe(gulp.dest(config.assetsPath + 'js'));
});
 
gulp.task('uglify', function() {
  return gulp.src(config.assetsPath + 'js/codemirror.js')
    .pipe(uglify())
    .pipe(gulp.dest(config.assetsPath + 'js'));
});

gulp.task('clean', function () {
    return gulp.src(config.lib, {read: false})
      .pipe(clean());
});

gulp.task('default', function(){ // https://github.com/gulpjs/gulp/issues/96
    runSequence('bower','copy','concat','uglify');
});