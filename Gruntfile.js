module.exports = function(grunt) {

    var bowerJs = [
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

    var bowerCss = [
        'backoffice/bower_components/normalize-css',
        'backoffice/bower_components/bootstrap/dist/css/bootstrap.css',
        'backoffice/bower_components/AdminLTE/dist/css/AdminLTE.css',
        'backoffice/bower_components/AdminLTE/dist/css/skins/skin-blue.css'
    ];

    grunt.initConfig({
        pkg: grunt.file.readJSON('./package.json'),
        concat: {
            js: { //target
                separator : ',',
                src: [
                    './backoffice/src/*.js',
                    './backoffice/src/**/*.js'
                ],
                dest: './public/backoffice/dist/scripts/app.js'
            },
            concatBowerCss: {
                separator : ';',
                src : bowerCss,
                dest: './public/backoffice/dist/style/bower.css'
            },
            concatBowerJs: {
                separator : ',',
                src : bowerJs,
                dest: './public/backoffice/dist/scripts/bower.js'
            }
        },
        uglify: {
            js: { //target
                src: ['./public/backoffice/dist/scripts/app.js'],
                dest: './public/backoffice/dist/scripts/app.js'
            },
            bowerJs: {
                src: './public/backoffice/dist/scripts/bower.js',
                dest: './public/backoffice/dist/scripts/bower.js'
            }
        },
        copy: {
            main: {
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
            prod: {
                files: [
                    {expand: true, cwd: './public/backoffice/dist',src: ['**'], dest: './public/backoffice/buildProd', filter: 'isFile'}
                ]
            }
        },
        less: {

            dev :{
                files: {
                    './public/backoffice/dist/style/all.css': './backoffice/src/all.less'
                }
            },
            prod :{
                options: {
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 3 versions"]}),
                        new (require('less-plugin-clean-css'))({advanced: true})
                    ]
                },
                files: {
                    './public/backoffice/dist/style/all.css': './backoffice/src/all.less'
                }
            }
        },
        cssmin:{
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    './public/backoffice/dist/style/bower.css': ['./public/backoffice/dist/style/bower.css']
                }
            }
        },
        watch : {
            all : {
                files : [
                    './backoffice/src/**',
                    './backoffice/src/*'
                ],
                tasks: ['concat:js', 'copy:main', 'less:dev'],
                options: {
                    livereload: true,
                }
            }
        },
        clean: {
            public: ["./public/backoffice/dist*"],
            buildProd: ["./public/backoffice/buildProd*"]
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
  			all:{
  				options:{
  					port:3000,
  					hostname:'localhost',
  					bases:['./public/backoffice/dist'],
  					livereload:true
  				}
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

    //register grunt default task
    grunt.registerTask('bo-server',['default','express','watch']);
    grunt.registerTask('bo-default', ['concat', 'copy:main', 'less:dev']);
    grunt.registerTask('bo-prod', ['clean','concat', 'uglify', 'copy:main', 'less:prod', 'cssmin', 'copy:prod']);

    grunt.registerTask('prod', ['bo-prod']);
    grunt.registerTask('default', ['bo-default']);

}
