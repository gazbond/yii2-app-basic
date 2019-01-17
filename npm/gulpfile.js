const del = require('del');

const gulp = require('gulp');
const sass = require('gulp-sass');
const cssClean = require('gulp-clean-css');
const cssPrefixer = require('gulp-autoprefixer');

const webpack = require('webpack');
const webpackStream = require('webpack-stream');

const webpackDevConfig = require('./webpack.dev.config');
const webpackProdConfig = require('./webpack.prod.config');

// TODO Browsersync not working
const bowsersync = require('browser-sync');

const distDir = '../web/dist/';
const fontsDir = '../web/fonts/';

gulp.task('clean', (cp) => {
    del([distDir], {force: true});
    cp();
});

gulp.task('reload-browser', (cp) => {
    // bowsersync.reload();
    cp();
});

gulp.task('build-dev-js', (cp) => {
    gulp.src('./webpack.dev.config.js')
        .pipe(webpackStream(webpackDevConfig, webpack).on('error', () => {}))
        .pipe(gulp.dest(distDir));
    cp();
});

gulp.task('build-prod-js', (cp) => {
    gulp.src('./webpack.prod.config.js')
        .pipe(webpackStream(webpackProdConfig, webpack).on('error', () => {}))
        .pipe(gulp.dest(distDir));
    cp();
});

gulp.task('build-bootstrap-sass', (cp) => {
    gulp.src('./lib/bootstrap.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cssClean({compatibility: 'ie8'}))
        .pipe(gulp.dest(distDir));
    cp();
});

gulp.task('move-bootstrap-fonts', (cp) => {
    gulp.src('node_modules/bootstrap-sass/assets/fonts/**/*')
        .pipe(gulp.dest(fontsDir));
    cp();
});

gulp.task('build-dev-sass', (cp) => {
    gulp.src('./src/index.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cssPrefixer())
        .pipe(gulp.dest(distDir));
    cp();
});

gulp.task('build-prod-sass', (cp) => {
    gulp.src('./src/index.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cssPrefixer())
        .pipe(cssClean({compatibility: 'ie8'}))
        .pipe(gulp.dest(distDir));
    cp();
});

gulp.task('move-images', (cp) => {
    gulp.src('./src/**/*.{png,jpg,jpeg,gif,svg}')
        .pipe(gulp.dest(distDir));
    cp();
});

gulp.task('watch', (cp) => {
    // bowsersync.init({
    //     proxy: "http://php",
    //     open: true
    // });
    gulp.watch('./src/**/*.js', gulp.series('build-dev-js', 'reload-browser'), (cp) => {
        cp();
    });
    gulp.watch('./src/**/*.scss', gulp.series('build-dev-sass', 'reload-browser'), (cp) => {
        cp();
    });
    gulp.watch('./src/**/*.{png,jpg,jpeg,gif,svg}', gulp.series('move-images', 'reload-browser'), (cp) => {
        cp();
    });
    cp();
});

gulp.task('dev', gulp.parallel(
    'build-dev-js',
    'build-dev-sass'
));

gulp.task('prod', gulp.series(
    'clean',
    gulp.parallel(
        'build-prod-js',
        'build-bootstrap-sass',
        'move-bootstrap-fonts',
        'build-prod-sass',
        'move-images'
    )
));

gulp.task('default', gulp.series('prod'));

