var basePaths = {
	scss: './sass/',
	js: './js/',
	img: './images/',
	fonts: './fonts/',
	node: './node_modules/',
	src: './src/',
};

var gulp = require('gulp')
var autoprefixer = require('autoprefixer');
var postcss = require('gulp-postcss');
var sass = require('gulp-sass');
var del = require('del');

gulp.task('css', function() {
	return gulp.src(basePaths.scss + '**/*.scss')
	.pipe(sass({
		outputStyle: 'expanded',
		indentType: 'tab',
		indentWidth: '1'
	}).on('error', sass.logError))
	.pipe(postcss([
		autoprefixer('last 2 versions', '> 1%')
	]))
	.pipe(gulp.dest('./'));
});

gulp.task('watch', function() {
	gulp.watch(['./**/*.css', './**/*.scss' ], ['css']);
});

gulp.task('clean-src', function() {
	return del([basePaths.src + '**/*']);
});

gulp.task('copy-assets', ['clean-src'], function() {
	var stream = gulp.src(basePaths.node + 'font-awesome/scss/*.scss')
		.pipe(gulp.dest(basePaths.src + 'font-awesome'));

	gulp.src(basePaths.node + 'font-awesome/fonts/**/*.{ttf,woff,woff2,eof,svg}')
		.pipe(gulp.dest(basePaths.fonts));

	return stream;
});

gulp.task('default', ['watch']);
