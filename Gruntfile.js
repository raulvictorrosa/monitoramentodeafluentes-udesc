/*globals module*/
module.exports = function(grunt) {
  // Project configuration.
  'use strict';

  require('load-grunt-tasks')(grunt); // Autoload your Grunt plugins


  // Init Grunt
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    projectname: 'Monitoramento de Afluentes',// Nome do Projeto

    // Diretórios
    dir: {
      bower: 'bower_components/', // Local pasta bower

      mainFolder: 'monitoramentodeafluentes', // Local pasta príncipal
      themeName: 'monitoramentodeafluentes-theme', // Nome do Tema
      themeDescription: 'Tema usado pela UDESC-CEPLAN para fazer o Monitoramento de Afluentes', // Descrição para o Tema
      themeSlug: 'monitoramentodeafluentes-udesc', // Descrição para o Tema
      themeAutor: 'Raul Victor Rosa <raulvictorrosa@gmail.com>', // Autor do Tema
      themeAURL: 'http://www.ceplan.udesc.br/', // URL do Autor do Tema

      content: '<%= dir.mainFolder %>/wp-content',//Local pasta wp-content
      themes: '<%= dir.content %>/themes', // Local da pasta themes
      theme: '<%= dir.themes %>/<%= dir.themeSlug %>/' // Local do tema
      // monitoramentodeafluentes/wp-content/themes/monitoramentodeafluentes-udesc
    },

    // Executa comandos de tarefas
    shell: {
      // Comandos para instalar plugins bower
      bower: {
        command: 'bower install'
      },

      // Download and install composer.phar
      composer: {
        command: [
          'curl -sS https://getcomposer.org/installer | php',
          'php composer.phar install'
        ].join('&&')
      },

      // Download wp-cli.phar
      wpCli: {
        command: 'if not exist "wp-cli.phar" curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar'
      },

      // Use wp-cli.phar to download wordpres's archives
      wpCoreDownload: {
        command: 'if not exist "<%= dir.mainFolder %>" php wp-cli.phar core download --version=4.6.1 --locale=pt_BR --path=<%= dir.mainFolder %>'
      },

      // Excluir alguns archivos e pastas do wordpress que não serão utilizados
      wpCleanup: {
        /*command: [
          'rm -rf <%= dir.content %>plugins/akismet <%= dir.themes %>twenty* <%= dir.content %>plugins/hello.php <%= dir.content %>languages/themes/twenty* <%= dir.content %>languages/plugins/akismet* <%= dir.mainFolder %>readme.html'
        ].join(';')*/
        command: [
          // 'rm -rf <%= dir.content %>languages/themes/twenty*',
          // 'rm -rf <%= dir.content %>languages/plugins/akismet*',
          // 'rm -rf <%= dir.content %>plugins/akismet',
          // 'rm -rf <%= dir.content %>plugins/hello.php',
          // 'rm -rf <%= dir.themes %>twenty*',
          'rm -rf <%= dir.mainFolder %>/readme.html'
        ].join(';')
      },

      wpThemeDownload: {
        command: [
          'if not exist data_base mkdir data_base',
          'cd <%= dir.themes %>',
          //'ls',
          'if not exist "<%= dir.themeSlug %>" underscores -n "<%= dir.themeName %>" -d "<%= dir.themeDescription %>" -g "<%= dir.themeSlug %>" -a "<%= dir.themeAutor %>" -u "<%= dir.themeAURL %>" -s -k',
          //'cd ..', 'cd ..', 'cd ..',
        ].join('&')
      }
    },

    // Copiar Arquivos
    copy: {
      theme: {
        files: [
          {
            // Copia os arquivos para style do bootstrap
            expand: true,
            cwd: '<%= dir.bower %>bootstrap-sass/assets/stylesheets/',
            src: ['**/*.scss'],
            dest: '<%= dir.theme %>sass/bootstrap-sass/'
          },
          {
            // Copia os arquivos para fonte do bootstrap
            expand: true,
            cwd: '<%= dir.bower %>bootstrap-sass/assets/fonts/bootstrap/',
            src: ['**/*'],
            dest: '<%= dir.theme %>fonts/bootstrap-fonts/'
          },
          {
            // Copia os arquivos para javascripts do bootstrap
            expand: true,
            cwd: '<%= dir.bower %>bootstrap-sass/assets/javascripts/',
            src: ['**/*'],
            dest: '<%= dir.theme %>js/bootstrap-js/'
          },
          {
            // Copia os arquivos jquery
            expand: true,
            cwd: '<%= dir.bower %>jquery/dist/',
            src: ['*'],
            dest: '<%= dir.theme %>js/jquery/'
          }
        ]
      }
    },

    // Tarefa SASS
    // Compila archivos sass
    sass: {
      style: {
        options: {
          sourcemap: 'none',
          // style: 'compressed'//Tranforms the file in minified
          // TODO after develop the site uncoment the attribute 'compressed',
          // and save one more time to compile, this attribute will minified the style.
        },
        files: {
          '<%= dir.theme %>style.css': '<%= dir.theme %>sass/style.scss',
          '<%= dir.theme %>layouts/content-login.css': '<%= dir.theme %>sass/layout/content-login.scss'
          // 'monitoramentodeafluentes/wp-content/themes/monitoramentodeafluentes-udesc/style.css': 'monitoramentodeafluentes/wp-content/themes/monitoramentodeafluentes-udesc/sass/style.scss',
          // 'monitoramentodeafluentes/wp-content/themes/monitoramentodeafluentes-udesc/layouts/content-login.css': 'monitoramentodeafluentes/wp-content/themes/monitoramentodeafluentes-udesc/sass/layout/content-login.scss',
        }
      }
    },

    // Tarefa postcss.
    // Adiciona prefixos para o style que deixam compativeis com outros navegadores.
    postcss: {
      options: {
        processors: [
          require('autoprefixer')({
            browsers: [
            "Android 2.3",
            "Android >= 4",
            "Chrome >= 20",
            "Firefox >= 24",
            "Explorer >= 8",
            "iOS >= 6",
            "Opera >= 12",
            "Safari >= 6"
            ]
          })
        ]
      },
      dist: {
        src: ['<%= dir.theme %>style.css']
      }
    },

    // Tarefas de Notificações
    notify_hooks: {
      options: {
        enabled: true,
        max_jshint_notifications: 5, // maximum number of notifications from jshint output
        title: '<%= projectname %>', // defaults to the name in package.json, or will use project directory's name
        // success: true, // whether successful grunt executions should be notified automatically
      }
    },
    notify: {
      // Notifica quando arquivo sass for compilado
      sass: {
        options: {
          title: '<%= projectname %>:sass',
          message: 'Compilado com sucesso.',
        }
      },

      // Notifica quando wordpress for instalado
      wpInstall: {
        options: {
          title: '<%= projectname %>:wordpress',
          message: 'Wordpress instalado com sucesso.',
        }
      },

      // Notifica quando archivos php forem modificados
      php: {
        options: {
          title: '<%= projectname %>:php',
          message: 'Arquivo PHP modificado.',
        }
      }
    },

    // Tarefa watch
    watch: {
      // Assiste todas as folhas de style para executar a tarefa que compila e que notifica que os arquivos foram alterados
      style: {
        files: [ '<%= dir.theme %>sass/**/*.scss' ],
        tasks: [ 'style', 'notify:sass' ]
      },

      // Assiste todod os archiver php e executa uma notificação de modificação
      // php: {
        // files: [ '<%= dir.theme %>**/*.php' ],
        // tasks: [ 'notify:php' ]
      // }
    }
  });

  // Default task(s).
  grunt.registerTask('bower',     ['shell:bower', 'copy']);
  grunt.registerTask('composer',  ['shell:composer']);
  grunt.registerTask('style',     ['sass', 'postcss']);
  grunt.registerTask('wpInstall', ['shell:wpCli', 'shell:wpCoreDownload', 'shell:wpThemeDownload', 'shell:wpCleanup', 'notify:wpInstall']);
  grunt.registerTask('install',   ['wpInstall', /*'composer',*/ 'bower']);

  grunt.registerTask('default', ['watch']);
};
