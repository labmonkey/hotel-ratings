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
    admin: {
        sass: ['./admin/src/sass/**/*.scss'],
        js: ['./admin/src/js/app.js']
    },
    web: {
        sass: ['./web/src/sass/**/*.scss'],
        js: ['./web/src/js/app.js']
    }
};

gulp.task('admin-sass', function () {
    task_sass(gulp, paths.admin.sass, './admin/assets/css');
});
gulp.task('web-sass', function () {
    task_sass(gulp, paths.web.sass, './web/assets/css');
});

gulp.task('admin-js', function () {
    task_js(gulp, paths.admin.js, './admin/assets/js');
});

gulp.task('web-js', function () {
    task_js(gulp, paths.web.js, './web/assets/js');
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
    gulp.watch(paths.admin.sass, ['admin-sass']);
    gulp.watch(paths.web.sass, ['web-sass']);

    // watch js
    gulp.watch(paths.admin.js, ['admin-js']);
    gulp.watch(paths.web.js, ['web-js']);
});

gulp.task('default', ['watch', 'browser-sync']);

var onError = function (err) {
    console.log(err);
    this.emit('end');
};

var task_js = function (gulp, paths, dest) {
    gulp.src(paths)
        .on('error', onError)
        .pipe(include())
        .on('error', onError)
        .pipe(uglify())
        .on('error', onError)
        .pipe(rename({
            extname: '.min.js'
        }))
        .on('error', onError)
        .pipe(gulp.dest(dest));
};

var task_sass = function (gulp, paths, dest) {
    gulp.src(paths)
        .pipe(sourcemaps.init())
        .on('error', onError)
        .pipe(include())
        .pipe(sass({
            includePaths: ['sass']
        }))
        .on('error', onError)
        .pipe(autoprefixer('last 3 versions'))
        .pipe(minifyCss({
            // advanced: false,
            compatibility: 'ie9'
        }))
        .pipe(rename({
            extname: '.min.css'
        }))
        .pipe(sourcemaps.write('.'))
        .on('error', onError)
        .pipe(gulp.dest(dest));
};
