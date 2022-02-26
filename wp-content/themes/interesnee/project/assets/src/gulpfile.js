const gulp = require('gulp');
const sass = require('gulp-sass');
const rename = require('gulp-rename');
const autoprefixer = require('gulp-autoprefixer');
const plumber = require('gulp-plumber');
const gcmq = require('gulp-group-css-media-queries');
const cleanCSS = require('gulp-clean-css');
const babel = require('gulp-babel');
const jsmin = require('gulp-uglify');

const config = {
  styles: {
    watch: './scss/**/*.scss',
    src: './scss/entries/*.scss',
    dest: '../css/',
  },
  scripts: {
    src: [
      './js/**/*.js',
      '!./js/**/*.min.js',
    ],
    dest: '../js/',
  },
};

/**
 * Styles minified
 *
 * @return {Object}
 */
function stylesFrontendMin() {
  return gulp.src(config.styles.src)
    .pipe(plumber())
    .pipe(sass({
      includePaths: ['node_modules'],
    }))
    .pipe(autoprefixer())
    .pipe(gcmq())
    .pipe(cleanCSS({level: {2: {all: true}}}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(config.styles.dest));
}

/**
 * Styles maxified
 *
 * @return {Object}
 */
function stylesFrontendMax() {
  return gulp.src(config.styles.src)
    .pipe(plumber())
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(gcmq())
    .pipe(gulp.dest(config.styles.dest));
}

/**
 * Styles series
 */
const styles = gulp.parallel(stylesFrontendMin, stylesFrontendMax);

const scripts = function () {
  return gulp.src(config.scripts.src)
    .pipe(babel({
      presets: ['@babel/env'],
    }))
    .pipe(jsmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(config.scripts.dest));
};

/**
 * Watch
 *
 * @return {void}
 */
function watch() {
  scripts();
  styles();
  gulp.watch(config.styles.watch, styles);
  gulp.watch(config.scripts.src, scripts);
}

/**
 * Default task
 */
gulp.task('default', styles);

/**
 * Watch task
 */
gulp.task('watch', watch);
