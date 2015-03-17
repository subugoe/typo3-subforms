var gulp = require('gulp'),
		sass = require('gulp-sass'),
		scsslint = require('gulp-scss-lint'),
		autoprefixer = require('gulp-autoprefixer'),
		cached = require('gulp-cached'),
		notify = require('gulp-notify'),
		codecept = require('gulp-codeception'),
		coffee = require('gulp-coffee');

var config = {
	paths: {
		sass: [
			'./Resources/Private/Scss/**/*.scss',
			'./Resources/Private/Scss/*.scss'
		],
		coffee: ['./Resources/Private/CoffeeScript/*.coffee']
	},
	autoprefixer: {
		browsers: [
			'last 2 versions',
			'safari 6',
			'ie 9',
			'android 4'
		],
		cascade: true
	}
};

gulp.task('sass', function () {
	gulp.src(config.paths.sass)
			.pipe(sass({
				style: 'compressed',
				errLogToConsole: true,
				sourcemaps: true
			}))
			.on('error', notify.onError({
				title: 'Sass Error',
				message: '<%= error.message %>'
			}))
			.pipe(autoprefixer(
					config.autoprefixer
			))
			.pipe(gulp.dest('./Resources/Public/Css/'))
});

gulp.task('lint', function () {
	gulp.src(config.paths.sass)
			.pipe(cached('scsslint'))
			.pipe(scsslint({
				'config': 'Build/.scss-lint.yml',
				'maxBuffer': 9999999
			}))
});

gulp.task('coffee', function () {
	gulp.src(config.paths.coffee)
			.pipe(coffee({bare: true}))
			.pipe(gulp.dest('./Resources/Public/JavaScript/'))
});

gulp.task('codecept', function() {
	gulp.src('./Tests/*.php').pipe(codecept());
});

gulp.task('compile', function () {
	gulp.start('sass', 'coffee', 'codecept')
});

gulp.task('watch', function () {
	gulp.watch([config.paths.sass, config.paths.coffee], ['lint', 'compile'])
});

gulp.task('default', function () {
	gulp.start('lint', 'compile', 'watch')
});
