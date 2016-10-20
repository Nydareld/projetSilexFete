
var config      = require('./gulp/gulpConfig.js');

var gulp        = require('gulp');
var clean       = require('gulp-clean');
var less       = require('gulp-less');
var concat      = require('gulp-concat');
var cleanCss    = require('gulp-clean-css');
var watch    = require('gulp-watch');
var connect     = require('gulp-connect');


function handleError(err) {
  console.log(err.toString());
  this.emit('end');
}

gulp.task('clean', function () {
    return gulp.src(config.dist)
        .pipe(clean());
});

gulp.task('css-bootstrap',[],  function () {
    // Concaténation et compilation
    return gulp.src([
        config.bootstrapCssPath+"/bootstrap.css",
        config.bootstrapCssPath+"/bootstrap-theme.css"
    ])
    .pipe(concat("bootstrap.css"))
    .pipe(gulp.dest(config.cssBuildDest));
});

gulp.task('less',[],  function () {
    // Concaténation et compilation
    return gulp.src(config.lessPath)
    .pipe(concat("custom.css"))
    .pipe(less().on('error', handleError))
    .pipe(gulp.dest(config.cssBuildDest));
});

gulp.task('allCss',['less','css-bootstrap'],  function () {
    // Concaténation des css
    return gulp.src(config.cssBuildDest+"/**/*.css")
    .pipe(concat("all.css"))
    .pipe(gulp.dest(config.publicDir+"/css"))
    .pipe(connect.reload());
});

gulp.task('mvStatic',[], function(){
    return gulp.src(config.staticFiles)
    .pipe(gulp.dest(config.staticDest))
    .pipe(connect.reload());
});

gulp.task('mvImgs',[], function(){
    return gulp.src(config.imagesFolder+"/**/*.*")
    .pipe(gulp.dest(config.imagesDest))
    .pipe(connect.reload());
});

gulp.task('mvTemplates',[], function(){
    return gulp.src(config.templateSource)
    .pipe(gulp.dest(config.templateDest))
    .pipe(connect.reload());
});

gulp.task('allMv',['mvStatic','mvImgs','mvTemplates']);

gulp.task('bowerJs',[], function () {
    return gulp.src(config.bowerComponentsJs)
    .pipe(concat('allBower.js'))
    .pipe(gulp.dest(config.jsBuildDest))
});

gulp.task('bootstrapJs',[], function () {
    // Concaténation et compilation
    return gulp.src([
        config.bootstrapJsPath+"/bootstrap.js"
    ])
    .pipe(concat('bootstrap.js'))
    .pipe(gulp.dest(config.jsBuildDest))
});

gulp.task('js',[],  function () {
    // Concaténation et compilation
    return gulp.src(config.jsPath)
    .pipe(concat("custom.js"))
    .pipe(gulp.dest(config.jsBuildDest));
});

gulp.task('allJs',['js','bootstrapJs','bowerJs'],  function () {
    // Concaténation et compilation
    return gulp.src(config.jsBuildDest+"/**/*.js")
    .pipe(concat("all.js"))
    .pipe(gulp.dest(config.publicDir+"/js"))
    .pipe(connect.reload());
});


gulp.task('dev',['allJs','allCss','allMv']);

gulp.task('watchDev',['dev'],function(){
    watch(config.lessPath, function() {
        gulp.start( 'allCss' );
    });
    watch(config.jsPath, function() {
        gulp.start( 'allJs' );
    });
    watch(config.staticFiles, function() {
        gulp.start( 'mvStatic' );
    });
    watch(config.imagesFolder, function() {
        gulp.start( 'mvImgs' );
    });
    watch(config.templateSource, function() {
        gulp.start( 'mvTemplates' );
    });
});


gulp.task('server',['watchDev'],function(){
    // server en live reload
    connect.server(config.serverConf);
})
