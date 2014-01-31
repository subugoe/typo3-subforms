/*global module:false*/
module.exports = function (grunt) {

	grunt.initConfig({

						// Liste der Dateien, deren Syntax mit JSHint geprüft werden soll
						lint:{files:['grunt.js', 'Resources/Public/Js/*.js'] },

						// Tasks, die mit 'grunt watch' ausgeführt werden sollen
						watch:{
							files:['<config:lint.files>', '<config:coffee.app.src>'],
							tasks:'compass coffee lint'},

						uglify:{},
						compass:{
							prod:{
								src:'Resources/Private/Sass',
								dest:'Resources/Public/Css',
								linecomments:false,
								outputstyle:'compressed',
								forcecompile:true,
								debugsass:false,
								relativeassets:true
							}
						},
						coffee:{
							app: {
								src: ['Resources/Private/CoffeeScript/*.coffee'],
								dest: 'Resources/Public/Js/',
								options: {
									bare: true
								}
							}
						}
					});

	// Default task, der ausgeführt wird, wenn man Grunt ohne weitere Parameter aufruft.
	grunt.registerTask('default', 'coffee compass lint');
	grunt.loadNpmTasks('grunt-compass');
	grunt.loadNpmTasks('grunt-coffee');
};