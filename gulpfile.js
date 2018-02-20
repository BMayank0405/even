const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const imagemin = require('gulp-imagemin');
const imageminMozjpeg = require('imagemin-mozjpeg');
let cleanCSS = require('gulp-clean-css');
let htmlmin = require('gulp-htmlmin');
const input = './scss/*.scss';
const output = './css';

const autoprefixerOptions = {
    browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};


gulp.task('htmltask', function () {
    return gulp.src(['./dev/*.php'])
        .pipe(htmlmin({
            collapseWhitespace: true,
            ignoreCustomFragments: [/<%[\s\S]*?%>/, /<\?[=|php]?[\s\S]*?\?>/]
        }))
        .pipe(gulp.dest('./temp/'));
});

gulp.task('sass', () => {
    return gulp
        .src(input)
        .pipe(sass())
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(gulp.dest(`${output}`));
});

gulp.task('minify', () => {
    return gulp.src('./css/*.css')
        .pipe(cleanCSS())
        .pipe(gulp.dest('./temp'));
});

//for converting jpeg image to progressive jpegs
gulp.task('mozjpeg', () =>
    gulp.src('./images/index/img/media/htcrop2.jpg')
    .pipe(imagemin(imageminMozjpeg({
        quality: 80
    })))
    .pipe(gulp.dest('./images/index/img/media/new'))
);


gulp.task('default', () => {
    gulp.watch(input, ['sass']);
});