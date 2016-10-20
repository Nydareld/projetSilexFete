
var dist = "./dist";

var app = "./app";

var lessPath = app+"/styles/less/**/*.less";
var jsPath = app+"/scripts/**/*.js";

var publicDir = dist+"/../../public/frontOffice";

var cssBuildDest = dist+"/build/css";
var jsBuildDest = dist+"/build/js";

var bowerPath = "./bower_components";

var bootstrapLessPath = bowerPath+"/bootstrap/less";
var bootstrapCssPath = bowerPath+"/bootstrap/dist/css";
var bootstrapJsPath = bowerPath+"/bootstrap/dist/js";

var bowerComponentsJs = [
    bowerPath+"/angular/angular.js",
    bowerPath+"/angular-route/angular-route.js",
    bowerPath+"/jquery/dist/jquery.js",
    bowerPath+"/angular-bootstrap/ui-bootstrap.js"
];

var staticFiles = [
    app+"/404.html",
    app+"/index.html",
    app+"/robot.txt",
];

var staticDest = publicDir;

var imagesFolder = app+"/img";
var imagesDest = publicDir+"/img";
var templateSource = app+'/templates/**/*.html';
var templateDest = publicDir+'/templates';

var serverConf = {
    root: publicDir,
    livereload: true,
    port: 4000
}

module.exports.serverConf = serverConf;
module.exports.templateSource = templateSource;
module.exports.templateDest = templateDest;

module.exports.staticFiles = staticFiles;
module.exports.staticDest = staticDest;

module.exports.imagesFolder = imagesFolder;
module.exports.imagesDest = imagesDest;

module.exports.bowerComponentsJs = bowerComponentsJs;

module.exports.dist = dist;
module.exports.app = app;
module.exports.lessPath = lessPath;
module.exports.jsPath = jsPath;
module.exports.publicDir = publicDir;
module.exports.cssBuildDest = cssBuildDest;
module.exports.jsBuildDest = jsBuildDest;
module.exports.bowerPath = bowerPath;
module.exports.bootstrapLessPath = bootstrapLessPath;
module.exports.bootstrapJsPath = bootstrapJsPath;
module.exports.bootstrapCssPath = bootstrapCssPath;
