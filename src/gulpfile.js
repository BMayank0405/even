const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const imagemin = require('gulp-imagemin');
const imageminMozjpeg = require('imagemin-mozjpeg');
let cleanCSS = require('gulp-clean-css');
let uglify = require('gulp-uglifyjs');
var htmlmin = require('gulp-html-minifier');
const input = './scss/*.scss';
const output = '../dist/css';
const temp = './temp';

const autoprefixerOptions = {
    browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};

gulp.task('htmltask', function () {
    return gulp.src(['./{index,career,about,footer,navbar}.php'])
        .pipe(htmlmin({
            collapseWhitespace: true,
            removeComments: true,
            removeRedundantAttributes: true,
            removeScriptTypeAttributes: true,
            removeStyleLinkTypeAttributes: true,
            removeComments: true,
            removeOptionalTags: true,
            minifyURLs: true,
            minifyCSS: true,
            minifyJS: true,
            ignoreCustomFragments: [/<\?[p][h][p][\s]*[a-z]*[_]*[a-z]*\s['][.][/][a-z]*[_]*[a-z]*[/]*[a-z]*[.][p][h][p]['][;][\s]*\?>/]
        }))
        .pipe(gulp.dest('../dist/'));
});

gulp.task('sass', () => {
    return gulp
        .src(input)
        .pipe(sass())
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(gulp.dest(temp))
});


gulp.task('minify', () => {
    return gulp.src(`${temp}/*.css`)
        .pipe(cleanCSS())
        .pipe(gulp.dest('../dist/css/'));
});
gulp.task('uglify', function () {
    gulp.src('./js/init.js')
        .pipe(uglify({
            sequences: true, // join consecutive statemets with the “comma operator”
            properties: true, // optimize property access: a["foo"] → a.foo
            dead_code: true, // discard unreachable code
            drop_debugger: true, // discard “debugger” statements
            unsafe: false, // some unsafe optimizations (see below)
            conditionals: true, // optimize if-s and conditional expressions
            comparisons: true, // optimize comparisons
            evaluate: true, // evaluate constant expressions
            booleans: true, // optimize boolean expressions
            loops: true, // optimize loops
            unused: true, // drop unused variables/functions
            hoist_funs: true, // hoist function declarations
            hoist_vars: false, // hoist variable declarations
            if_return: true, // optimize if-s followed by return/continue
            join_vars: true, // join var declarations
            cascade: true, // try to cascade `right` into `left` in sequences
            side_effects: true, // drop side-effect-free statements
            warnings: true, // warn about potentially dangerous optimizations/code
            global_defs: {}
        }))
        .pipe(gulp.dest('./dist/js'))
});


//for converting jpeg image to progressive jpegs
//for converting jpeg image to progressive jpegs
gulp.task('mozjpeg', () =>
    gulp.src('../dist/images/index/partner/jpeg/*.jpeg')
    .pipe(imagemin([imageminMozjpeg({
        quality: 80
    })]))
    .pipe(gulp.dest('../dist/images/index/partner/jpeg/jpeg-p/'))
);


gulp.task('default', () => {
    gulp.watch(input, ['sass', 'minify']);
});