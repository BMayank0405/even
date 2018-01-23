const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const imagemin = require('gulp-imagemin');
const imageminMozjpeg = require('imagemin-mozjpeg');


const input = './scss/*.scss';
const output = './css';

const autoprefixerOptions = {
    browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};


gulp.task('sass', () => {
    return gulp
        .src(input)
        .pipe(sass())
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(gulp.dest(output));
});

//for converting jpeg image to progressive jpegs
gulp.task('mozjpeg', () =>
    gulp.src('img/*.jpg')
    .pipe(imagemin([imageminMozjpeg({
        quality: 80
    })]))
    .pipe(gulp.dest('dist/images'))
);


gulp.task('default', () => {
    gulp.watch(input, ['sass']);
});