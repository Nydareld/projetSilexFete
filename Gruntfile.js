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
            boConcatJs: { //target
                separator : ',',
                src: [
                    './backoffice/src/*.js',
                    './backoffice/src/**/*.js'
                ],
                dest: './public/backoffice/dist/scripts/app.js'
            },
            boVoncatBowerCss: {
                separator : ';',
                src : bowerCss,
                dest: './public/backoffice/dist/style/bower.css'
            },
            boConcatBowerJs: {
                separator : ',',
                src : bowerJs,
                dest: './public/backoffice/dist/scripts/bower.js'
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
            }
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
            }
        },
        watch : {
            boAll : {
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
            boPublic: ["./public/backoffice/dist*"],
            boBuildProd: ["./public/backoffice/buildProd*"]
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

    grunt.registerTask('bo-clean',['clean:boPublic','clean:boBuildProd']);
    grunt.registerTask('bo-concat',['concat:boConcatJs','concat:boVoncatBowerCss','concat:boConcatBowerJs']);
    grunt.registerTask('bo-copy-main',['copy:boMain']);
    grunt.registerTask('bo-copy-prod',['copy:boProd']);
    grunt.registerTask('bo-cssmin',['cssmin:bo']); // care
    grunt.registerTask('bo-express',['express:boAll']);
    grunt.registerTask('bo-less-prod',['less:boProd']);
    grunt.registerTask('bo-less-dev',['less:boDev']);
    grunt.registerTask('bo-uglify',['uglify:boJs',"uglify:boBowerJs"]);
    grunt.registerTask('bo-watch',['watch:boAll']);

    //register grunt default task
    grunt.registerTask('bo-server',['bo-default','bo-express','bo-watch']);
    grunt.registerTask('bo-default', ['bo-concat', 'bo-copy-main', 'bo-less-dev']);
    grunt.registerTask('bo-prod', ['bo-clean','bo-concat', 'bo-uglify', 'bo-copy-main', 'bo-less-prod', 'bo-cssmin', 'bo-copy-prod']);

    grunt.registerTask('server', ['bo-server']);
    grunt.registerTask('prod', ['bo-prod']);
    grunt.registerTask('default', ['bo-default']);

}
