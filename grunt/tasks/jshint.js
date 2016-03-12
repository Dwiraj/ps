/**
 * jshint.js
 *
 * Validates javascript code styling
 *
 * @package grunt
 * @subpackage tasks
 */

module.exports = function(grunt) {
	grunt.config('jshint', {
		options: {
			jshintrc: true,
			reporter: require('jshint-stylish')
		},
		assets: [
			'<%=paths.js%>public/app/**/*.js'
		]
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
};
