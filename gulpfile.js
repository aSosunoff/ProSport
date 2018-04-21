/* npm init */
/* npm i gulp gulp-concat-css gulp-clean-css gulp-rename gulp-autoprefixer gulp-uglify gulp-concat gulp-imagemin --save-dev */
/* npm list --depth=0 */

var gulp = require('gulp'),
    concatCss = require('gulp-concat-css'),
    cleanCss = require('gulp-clean-css'),
    renameFile = require("gulp-rename"),
    autoprefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    imagemin = require('gulp-imagemin');

// css_frontend
gulp.task('css_frontend', function() {
    return gulp.src([
        'frontend/web/library/owlcarousel/assets/owl.carousel.min.css',
        'frontend/web/library/owlcarousel/assets/owl.theme.default.min.css',
        'frontend/web/library/fancybox/dist/jquery.fancybox.min.css',

        'frontend/web/css/frontend.css',
        'frontend/web/css/footer-bottom.css'])
        .pipe(autoprefixer({
            browsers: ['last 20 versions']
        }))
        .pipe(concatCss('all.css'))
        .pipe(gulp.dest('frontend/web/css/'))
        .pipe(cleanCss())
        .pipe(renameFile("all.min.css"))
        .pipe(gulp.dest('frontend/web/css/'));
});

// css_backend
gulp.task('css_backend', function() {
    return gulp.src([
        'backend/web/css/gentelella-custom.css',
        'backend/web/css/backend.css'])
        .pipe(autoprefixer({
            browsers: ['last 20 versions']
        }))
        .pipe(concatCss('all.css'))
        .pipe(gulp.dest('backend/web/css/'))
        .pipe(cleanCss())
        .pipe(renameFile("all.min.css"))
        .pipe(gulp.dest('backend/web/css/'));
});

// css_common
gulp.task('css_common', function() {
    return gulp.src([
        'common/web/css/fonts.css',
        'common/web/css/common.css',

        'common/web/css/fonts/custom-icon/custom-icon/style.css',
        'common/web/css/fonts/custom-icon/web-cook/style.css',

        'common/web/css/BEM/**/*.css',

        'common/web/css/Redefinition-Bootstrap/**/*.css',
        'common/web/css/components/box-switch.css'])
        .pipe(autoprefixer({
            browsers: ['last 20 versions']
        }))
        .pipe(concatCss('all.css'))
        .pipe(gulp.dest('common/web/css/'))
        .pipe(cleanCss())
        .pipe(renameFile("all.min.css"))
        .pipe(gulp.dest('common/web/css/'));
});

gulp.task('js_frontend', function (cb) {
    return gulp.src([
        'frontend/web/library/owlcarousel/owl.carousel.min.js',
        'frontend/web/library/elevatezoom/jquery.elevateZoom-3.0.8.min.js',
        'frontend/web/library/fancybox/dist/jquery.fancybox.min.js',
        'frontend/web/library/landing-nav/navigation.js',

        'frontend/web/js/project/call-me.js',

        'frontend/web/js/frontend.js',
        'frontend/web/js/setting.js',
        'frontend/web/js/scroll-up.js'])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('frontend/web/js/'))
        .pipe(uglify())
        .pipe(renameFile("all.min.js"))
        .pipe(gulp.dest('frontend/web/js/'));
});

gulp.task('js_backend', function (cb) {
    return gulp.src([
        'backend/web/js/backend.js',
        'backend/web/js/setting.js'])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('backend/web/js/'))
        .pipe(uglify())
        .pipe(renameFile("all.min.js"))
        .pipe(gulp.dest('backend/web/js/'));
});

gulp.task('js_common', function (cb) {
    return gulp.src([
        'common/web/js/component/AJAXGlobal.js',
        'common/web/js/component/Message.js',
        'common/web/js/component/Animate_Load.js'])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('common/web/js/'))
        .pipe(uglify())
        .pipe(renameFile("all.min.js"))
        .pipe(gulp.dest('common/web/js/'));
});

// gulp.task('jQuery', function (cb) {
//     return gulp.src([
//         'web/js/jquery/jquery-3.2.1.min.js'])
//         .pipe(gulp.dest('web/dist/'));
// });

// gulp.task('imagemin', function() {
//     return gulp.src('frontend/web/images/**/*')
//         .pipe(imagemin({
//             interlaced: true,
//             progressive: true,
//             optimizationLevel: 5,
//         }))
//         .pipe(gulp.dest('frontend/web/dist/images/'));
// });

gulp.task('default',[
    'css_frontend',
    'css_backend',
    'css_common',
    'js_frontend',
    'js_backend',
    'js_common'
    //'jQuery',
    //'imagemin'
]);