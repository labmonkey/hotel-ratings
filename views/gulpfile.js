var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    include = require('gulp-include'),
    minifyCss = require('gulp-clean-css'),
    sourcemaps = require('gulp-sourcemaps'),
    rename = require('gulp-rename'),
    uglify = require('gulp-uglify'),
    browserSync = require('browser-sync');

var paths = {
    sass: ['./web/src/sass/**/*.scss', './admin/src/sass/**/*.scss'],
    jsLibs: ['./web/src/js/libs.js', './admin/src/js/libs.js'],
    jsApp: ['./web/src/js/app.js', './web/src/js/app.js']
};

gulp.task('sass', function () {
    return gulp.src(paths.sass)
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: ['sass']
        }))
        .on('error', onError)
        .pipe(autoprefixer('last 3 versions'))
        .pipe(minifyCss({
            // advanced: false,
            compatibility: 'ie9'
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(rename({
            extname: '.min.js'
        }))
        .on('error', onError)
        .pipe(gulp.dest('./web/assets/css'));
});

gulp.task('js-app', function () {
    gulp.src(paths.jsApp)
        .on('error', onError)
        .pipe(include())
        .on('error', onError)
        .pipe(uglify())
        .on('error', onError)
        .pipe(rename({
            extname: '.min.js'
        }))
        .on('error', onError)
        .pipe(gulp.dest('./web/assets/js'));
});

gulp.task('js-libs', function () {
    gulp.src(paths.jsLibs)
        .on('error', onError)
        .pipe(include())
        .on('error', onError)
        .pipe(uglify())
        .on('error', onError)
        .pipe(rename({
            extname: '.min.js'
        }))
        .on('error', onError)
        .pipe(gulp.dest('./web/assets/js'));
});

gulp.task('browser-sync', function () {
    browserSync.init(['./**/*.twig', './**/assets/css/*.css', './**/src/js/*.js'], {
        open: false,
        server: {
            baseDir: "./",
            directory: true
        }
    });
});

gulp.task('watch', function () {
    // watch sass
    gulp.watch(paths.sass, ['sass']);

    // watch js
    gulp.watch(paths.jsApp, ['js-app']);
    gulp.watch(paths.jsLibs, ['js-libs']);
});

gulp.task('default', ['watch', 'browser-sync']);

var onError = function (err) {
    console.log(err);
    this.emit('end');
};
