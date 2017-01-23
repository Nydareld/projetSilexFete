module.exports = function(grunt) {

    var boBowerJs = [
        'backoffice/bower_components/jquery/dist/jquery.js',
        'backoffice/bower_components/bootstrap/dist/js/bootstrap.js',
        'backoffice/bower_components/angular/angular.js',
        'backoffice/bower_components/angular-resource/angular-resource.js',
        'backoffice/bower_components/angular-route/angular-route.js',
        'backoffice/bower_components/angular-animate/angular-animate.js',
        'backoffice/bower_components/angular-touch/angular-touch.js',
        'backoffice/bower_components/angular-bootstrap/ui-bootstrap-tpls.js',
        'backoffice/bower_components/AdminLTE/dist/js/app.js',
        'backoffice/bower_components/keycloak/dist/keycloak.js'

    ];

    var boBowerCss = [
        'backoffice/bower_components/normalize-css',
        'backoffice/bower_components/bootstrap/dist/css/bootstrap.css',
        'backoffice/bower_components/AdminLTE/dist/css/AdminLTE.css',
        'backoffice/bower_components/AdminLTE/dist/css/skins/skin-blue.css'
    ];

    var foBowerJs = [
        'frontoffice/bower_components/jquery/dist/jquery.js',
        'frontoffice/bower_components/bootstrap/dist/js/bootstrap.js',
        'frontoffice/bower_components/angular/angular.js',
        'frontoffice/bower_components/angular-resource/angular-resource.js',
        'frontoffice/bower_components/angular-route/angular-route.js',
        'frontoffice/bower_components/angular-animate/angular-animate.js',
        'frontoffice/bower_components/angular-touch/angular-touch.js',
        'frontoffice/bower_components/angular-bootstrap/ui-bootstrap-tpls.js',
        'frontoffice/bower_components/keycloak/dist/keycloak.js'

    ];

    var foBowerCss = [
        'frontoffice/bower_components/normalize-css',
        'frontoffice/bower_components/bootstrap/dist/css/bootstrap.css'
    ];

    grunt.initConfig({
        pkg: grunt.file.readJSON('./package.json'),
        concat: {
            boConcatJs: {
                separator : ',',
                src: [
                    './backoffice/src/*.js',
                    './backoffice/src/**/*.js'
                ],
                dest: './public/backoffice/dist/scripts/app.js'
            },
            boConcatBowerCss: {
                separator : ';',
                src : boBowerCss,
                dest: './public/backoffice/dist/style/bower.css'
            },
            boConcatBowerJs: {
                separator : ',',
                src : boBowerJs,
                dest: './public/backoffice/dist/scripts/bower.js'
            },
            foConcatJs: {
                separator : ',',
                src: [
                    './frontoffice/src/*.js',
                    './frontoffice/src/**/*.js'
                ],
                dest: './public/frontoffice/dist/scripts/app.js'
            },
            foConcatBowerCss: {
                separator : ';',
                src : foBowerCss,
                dest: './public/frontoffice/dist/style/bower.css'
            },
            foConcatBowerJs: {
                separator : ',',
                src : foBowerJs,
                dest: './public/frontoffice/dist/scripts/bower.js'
            }
        },
        uglify: {
            boJs: { //target
                src: ['./public/backoffice/dist/scripts/app.js'],
                dest: './public/backoffice/dist/scripts/app.js'
            },
            boBowerJs: {
                src: './public/backoffice/dist/scripts/bower.js',
                dest: './public/backoffice/dist/scripts/bower.js'
            },
            foJs: { //target
                src: ['./public/frontoffice/dist/scripts/app.js'],
                dest: './public/frontoffice/dist/scripts/app.js'
            },
            foBowerJs: {
                src: './public/frontoffice/dist/scripts/bower.js',
                dest: './public/frontoffice/dist/scripts/bower.js'
            }
        },
        copy: {
            boMain: {
                files: [
                    // includes files within path
                    {
                        expand: true,
                        cwd : 'backoffice/src/',
                        src: [
                            '**.html',
                            '**/*.html'
                        ],
                        dest: './public/backoffice/dist'
                    },{
                        expand: true,
                        cwd : 'backoffice/statics/',
                        src: ["**"],
                        // filter: 'isFile',
                        dest: './public/backoffice/dist/statics'
                    }
                ]
            },
            boProd: {
                files: [
                    {expand: true, cwd: './public/backoffice/dist',src: ['**'], dest: './public/backoffice/buildProd', filter: 'isFile'}
                ]
            },
            foMain: {
                files: [
                    // includes files within path
                    {
                        expand: true,
                        cwd : 'frontoffice/src/',
                        src: [
                            '**.html',
                            '**/*.html'
                        ],
                        dest: './public/frontoffice/dist'
                    },{
                        expand: true,
                        cwd : 'frontoffice/statics/',
                        src: ["**"],
                        // filter: 'isFile',
                        dest: './public/frontoffice/dist/statics'
                    }
                ]
            },
            foProd: {
                files: [
                    {expand: true, cwd: './public/frontoffice/dist',src: ['**'], dest: './public/frontoffice/buildProd', filter: 'isFile'}
                ]
            },
        },
        less: {

            boDev :{
                files: {
                    './public/backoffice/dist/style/all.css': './backoffice/src/all.less'
                }
            },
            boProd :{
                options: {
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 3 versions"]}),
                        new (require('less-plugin-clean-css'))({advanced: true})
                    ]
                },
                files: {
                    './public/backoffice/dist/style/all.css': './backoffice/src/all.less'
                }
            },
            foDev :{
                files: {
                    './public/frontoffice/dist/style/all.css': './frontoffice/src/all.less'
                }
            },
            foProd :{
                options: {
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 3 versions"]}),
                        new (require('less-plugin-clean-css'))({advanced: true})
                    ]
                },
                files: {
                    './public/frontoffice/dist/style/all.css': './frontoffice/src/all.less'
                }
            }
        },
        cssmin :{
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            bo : {
                files: {
                    './public/backoffice/dist/style/bower.css': ['./public/backoffice/dist/style/bower.css']
                }
            },
            fo : {
                files: {
                    './public/frontoffice/dist/style/bower.css': ['./public/frontoffice/dist/style/bower.css']
                }
            }
        },
        watch : {
            boAll : {
                files : [
                    './backoffice/src/**',
                    './backoffice/src/*'
                ],
                tasks: ['concat:boConcatJs', 'copy:boMain', 'less:boDev'],
                options: {
                    livereload: {
                        host: 'localhost',
                        port: 35728,
                    }
                }
            },
            foAll : {
                files : [
                    './frontoffice/src/**',
                    './frontoffice/src/*'
                ],
                tasks: ['concat:foConcatJs', 'copy:foMain', 'less:foDev'],
                options: {
                    livereload: {
                        host: 'localhost',
                        port: 35729,
                    }
                }
            }
        },
        clean: {
            boPublic: ["./public/backoffice/dist*"],
            boBuildProd: ["./public/backoffice/buildProd*"],
            foPublic: ["./public/frontoffice/dist*"],
            foBuildProd: ["./public/frontoffice/buildProd*"]
        },
        ngAnnotate: {
            options: {
                singleQuotes : true
            },
            app: {
                files: {

                }
            }
        },
  		express:{
  			boAll:{
  				options:{
  					port:3000,
  					hostname:'localhost',
  					bases:['./public/backoffice/dist'],
  					livereload:true
  				}
  			},
            foAll:{
                options:{
                    port:4000,
                    hostname:'localhost',
                    bases:['./public/frontoffice/dist'],
                    livereload:true
                }
            }
  		},
        concurrent: {
            options: {
                logConcurrentOutput: true
            },
            server: {
                tasks: ["fo-server", "bo-server"]
            }
        }
    });

    //load grunt tasks
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-express');
    grunt.loadNpmTasks('grunt-concurrent');


    // Unit task for backoffice
    grunt.registerTask('bo-clean',['clean:boPublic','clean:boBuildProd']);
    grunt.registerTask('bo-concat',['concat:boConcatJs','concat:boConcatBowerCss','concat:boConcatBowerJs']);
    grunt.registerTask('bo-copy-main',['copy:boMain']);
    grunt.registerTask('bo-copy-prod',['copy:boProd']);
    grunt.registerTask('bo-cssmin',['cssmin:bo']);
    grunt.registerTask('bo-express',['express:boAll']);
    grunt.registerTask('bo-less-prod',['less:boProd']);
    grunt.registerTask('bo-less-dev',['less:boDev']);
    grunt.registerTask('bo-uglify',['uglify:boJs',"uglify:boBowerJs"]);
    grunt.registerTask('bo-watch',['watch:boAll']);

    // Complex task for backoffice
    grunt.registerTask('bo-server',['bo-default','bo-express','bo-watch']);
    grunt.registerTask('bo-default', ['bo-concat', 'bo-copy-main', 'bo-less-dev']);
    grunt.registerTask('bo-prod', ['bo-clean','bo-concat', 'bo-uglify', 'bo-copy-main', 'bo-less-prod', 'bo-cssmin', 'bo-copy-prod']);

    // Unit task for frontoffice
    grunt.registerTask('fo-clean',['clean:foPublic','clean:foBuildProd']);
    grunt.registerTask('fo-concat',['concat:foConcatJs','concat:foConcatBowerCss','concat:foConcatBowerJs']);
    grunt.registerTask('fo-copy-main',['copy:foMain']);
    grunt.registerTask('fo-copy-prod',['copy:foProd']);
    grunt.registerTask('fo-cssmin',['cssmin:fo']);
    grunt.registerTask('fo-express',['express:foAll']);
    grunt.registerTask('fo-less-prod',['less:foProd']);
    grunt.registerTask('fo-less-dev',['less:foDev']);
    grunt.registerTask('fo-uglify',['uglify:foJs',"uglify:foBowerJs"]);
    grunt.registerTask('fo-watch',['watch:foAll']);

    // Complex task for frontoffice
    grunt.registerTask('fo-server',['fo-default','fo-express','fo-watch']);
    grunt.registerTask('fo-default', ['fo-concat', 'fo-copy-main', 'fo-less-dev']);
    grunt.registerTask('fo-prod', ['fo-clean','fo-concat', 'fo-uglify', 'fo-copy-main', 'fo-less-prod', 'fo-cssmin', 'fo-copy-prod']);


    // Global tasks
    grunt.registerTask('server', ['concurrent:server']);
    grunt.registerTask('prod', ['bo-prod','fo-prod']);
    grunt.registerTask('default', ['bo-default','fo-default']);

}
