// Include dependencies
var autoprefixer = require('gulp-autoprefixer');
var gulp = require('gulp')
var include = require('gulp-include');
var livereload = require('gulp-livereload');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var sass = require('gulp-ruby-sass');
var uglify = require('gulp-uglify');

// Convert SASS to CSS
gulp.task('css', function () {
    return gulp.src('sass/all.scss')
        .pipe(plumber())
        .pipe(sass({style: 'compressed', 'sourcemap=none': true}))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest('css'))
        .pipe(livereload({ auto: false }))
        .pipe(notify({ message: 'Compiled CSS (<%=file.relative%>)' }));
});

// Minify JavaScript
gulp.task('js', function() {
    return gulp.src('js/all.js')
        .pipe(plumber())
        .pipe(include())
        .pipe(uglify())
        .pipe(rename('all.min.js'))
        .pipe(gulp.dest('js'))
        .pipe(notify({ message: 'Minified JS (<%=file.relative%>)' }));
});

// Setup LiveReload and watcher
gulp.task('default', function () {

    // Create LiveReload server
    var server = livereload();
    livereload.listen();

    // Watch .scss files
    gulp.watch([
        'sass/*.scss',
        'sass/**/*.scss'
    ], function (file) {
        gulp.run('css');
    })

    // Watch .js files
    gulp.watch([
        'js/*.js'
    ], function (file) {
        gulp.run('js');
    })
});