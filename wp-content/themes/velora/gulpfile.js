// Initialize modules
const { src, dest, watch, series, parallel } = require('gulp');
const autoprefixer = require('autoprefixer');
const notify = require('gulp-notify');
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const sass = require('gulp-sass')(require('sass'));
const sassLint = require('gulp-sass-lint');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const iconfont = require('gulp-iconfont');
const iconfontCss = require('gulp-iconfont-css');
const svgmin = require('gulp-svgmin');
const webpack = require('webpack-stream');
const plumber = require('gulp-plumber');

// File path variables
const files = {
	scssPath: 'assets/scss/**/*.scss',
	scssPathBlocks: 'template-views/**/**/*.scss',
	jsPathBlocks: 'assets/js/**/*.js',
	jsPath: 'assets/js/*.js'
}

//error notification settings for plumber
var msgERROR = {
	errorHandler: notify.onError({
		title: 'Fix that ERROR:',
		message: "<%= error.message %>",
		time: 2000
	})
};

//icon fonts
function fonticons() {
	return src(['assets/svg/*.svg'])
		.pipe(iconfontCss({
			fontName: 'fonticons',
			cssClass: 'font',
			path: 'assets/config/icon-font-config.scss',
			targetPath: '../../assets/scss/base/_icon-font.scss',
			fontPath: 'assets/icons/'
		}))
		.pipe(iconfont({
			fontName: 'fonticons', // required
			prependUnicode: true, // recommended option
			formats: ['woff2', 'woff', 'ttf'], // default, 'woff2' and 'svg' are available
			normalize: true,
			centerHorizontally: true
		}))
		.on('glyphs', function(glyphs, options) {
			// CSS templating, e.g.
			console.log(glyphs, options);
		})
		.pipe(dest('assets/icons/'))
};

// SVG optimization
function svgomg() {
	return src('assets/svg/*.svg')
		.pipe(svgmin({
			plugins: [
				{ removeTitle: true },
				{ removeRasterImages: true },
				{ sortAttrs: true }
				//{ removeStyleElement: true }
			]
		}))
		.pipe(dest('assets/svg'))
};

exports.fonticons = series(
	series(svgomg, fonticons)
)

// Sass task
function scssTask() {
	return src(files.scssPath)
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(postcss([autoprefixer()]))
		.pipe(sourcemaps.write('.'))
		.pipe(dest(__dirname));
}

// Sass lint task
function scsslintTask() {
	return src(files.scssPath)
		.pipe(sassLint({
            configFile: '.sass-lint.yml',
        }))
		.pipe(sassLint.format())
}

// Sass minify task
function scssminTask() {
	return src(files.scssPath)
		.pipe(sass())
		.pipe(postcss([ autoprefixer(), cssnano() ]))
		.pipe(concat('style.min.css'))
		.pipe(dest(__dirname));
}

// JS task
function jsTask() {
	return src(files.jsPath)
		.pipe(plumber())
    	.pipe(webpack(require('./webpack.config.js')))
		.pipe(uglify())
		.pipe(concat('site.min.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('dist'));
}

// Watch task
function watchTask() {
	watch([ files.scssPath, files.scssPathBlocks, files.jsPath, files.jsPathBlocks, ],
		parallel(scssTask, scsslintTask, scssminTask, jsTask));
}

// Default task
exports.default = series(
	parallel(scssTask, scsslintTask, scssminTask, jsTask),
	watchTask
)