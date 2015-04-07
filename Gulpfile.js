// Gulp.js configuration

// include gulp and plugins
var
    gulp = require('gulp'),
    del = require('del'),
    newer = require('gulp-newer'),
    imagemin = require('gulp-imagemin'),
    pleeease = require('gulp-pleeease'),
    size = require('gulp-size'),
    sass = require('gulp-sass'),
    bower = require('gulp-bower'),
    //cache = require('gulp-cache'),
    //changed = require('gulp-changed'),
    //gutil = require('gulp-util'),
    colors  = require('colors'),
    minimist = require('minimist'),
    browserify = require('browserify'),
    //vinyl = require('vinyl-source-stream'),
    streamify = require('gulp-streamify'),
    transform = require('vinyl-transform');
    uglify = require('gulp-uglify'),
    gulpif = require('gulp-if'),
    jshint = require('gulp-jshint'),
    notify = require('gulp-notify'),
    concat = require('gulp-concat'),
    zip = require('gulp-zip'),
    //merge = require('merge-stream'),
    rubySass = require('gulp-ruby-sass'),
    browserSync = require('browser-sync'),
    plumber = require('gulp-plumber'),
    through = require('through'),
    pkg = require('./package.json');

// command line option --env <environment>
var optionList = {
    string: ['env', 'deploy'],
    default: {
        env: process.env.DEPLOY || 'dev'
    }
};
var prodBuild = (minimist(process.argv.slice(2), optionList).env === 'prod');

// File location and config
var
    source = './source/',
    dest = './build/',

    images = {
        in: source + 'assets/images/**/*.*',
        out: dest + 'assets/images/'
    };

    vendors = {
        in: source + 'assets/vendor/**/*'
    };

    css = {
        in: source + 'assets/scss/style.scss',
        watch: [source + 'assets/scss/**/*'],
        out: dest + 'assets/css/',
        sassOpts: {
            outputStyle: 'nested',
            imagePath: '../img',
            precision: 3,
            errLogToConsole: true
        },
        pleeeaseOpts: {
            autoprefixer: { browsers: ['last 2 versions', '> 2%'] },
            rem: ['16px'],
            pseudoElements: true,
            mqpacker: true,
            minifier: prodBuild
        }
    };

    js = {
        in: source + 'assets/js/*.js',
        out: dest + 'assets/js/'
    }

    php = {
        in: source + '/**/*.php',
        out: dest
    }

    themeLanguage = {
        in: source + 'assets/languages/*.*',
        out: dest + 'assets/languages/'
    }

    themeDescription = {
        in: source + 'style.css',
        out: dest
    }

    fonts = {
        in: [source + 'assets/vendor/font-awesome/fonts/*.*'],
        out: dest + 'assets/fonts'
    }

    //browserReload = browserSync.reload;

// print build type
console.log(pkg.name.bold.red + ' ' + pkg.version.bold.red + ', ' + (prodBuild ? 'production'.bold.green : 'development'.bold.green) + ' build'.bold.green);

// Defined tasks
gulp.task('clean', function(){
    del(dest + '*');
});

gulp.task('images', function(){
    return gulp.src(images.in)
        .pipe(newer(images.out))
        .pipe(imagemin())
        .pipe(gulp.dest(images.out));
});

gulp.task('sass', function() {
    return gulp.src(css.in)
        //.pipe(sass(css.sassOpts))
	      .pipe(rubySass({'sourcemap=none': true, 'noCache': true}))
        .on("error", notify.onError())
        .pipe(size({title: 'CSS in '}))
        .pipe(pleeease(css.pleeeaseOpts))
        .pipe(size({title: 'CSS out '}))
        .pipe(gulp.dest(css.out))
        .pipe(browserSync.reload({stream: true}));
});

// show help
gulp.task('help', function() {
    console.log('');
    console.log('gulp ' + '--env=prod|dev --deploy=none|zip|ftp' + '     # default: --env=dev --deploy=none');
    console.log('');
});

gulp.task('browserify', function () {
    var browserified = transform(function (filename) {
        var options = { debug: !prodBuild }
        var b = browserify(filename, options);
        return b.bundle();
    });

    return gulp.src(js.in)
        .pipe(browserified)
        .pipe(gulpif(prodBuild,uglify()))
        //.pipe(concat('bundle.js'))
        .pipe(gulp.dest(js.out));
});

gulp.task('jshint', function() {
   return gulp.src(source + 'assets/js/**/*.js')
       .pipe(jshint())
       .pipe(jshint.reporter('default'));
});

gulp.task('php', function() {
    if (prodBuild) {
        del([dest + php.out]);
    }
    return gulp.src(php.in)
        .pipe(newer(php.out))
        .pipe(gulp.dest(php.out))
        .pipe(browserSync.reload({stream: true}));
});


gulp.task('themeDescription',function() {
    return gulp.src(themeDescription.in)
        .pipe(gulp.dest(themeDescription.out));
});

gulp.task('themeLanguage', function() {
    return gulp.src(themeLanguage.in)
        .pipe(gulp.dest(themeLanguage.out))
});


gulp.task('deploy',['default'], function() {
    return gulp.src('build/**/*')
        .pipe(zip('mytheme.zip'))
        .pipe(gulp.dest('dist'));
});

gulp.task('browser-sync', function() {
    browserSync.init(null, {
        proxy: "localhost/~bernt/wordpress"
    });
});

gulp.task('fonts', function() {
   return gulp.src(fonts.in)
       .pipe(gulp.dest(dest + 'assets/fonts/'));
});

// default task
gulp.task('default',['images','sass','browserify','jshint','php','themeDescription', 'themeLanguage', 'fonts'], function() {
        return gulp.src('').pipe(notify({ message: 'default task complete.' }));
});

gulp.task('watch',['browser-sync'], function() {
    gulp.watch(images.in, ['images']);
    gulp.watch(css.watch, ['sass']);
    gulp.watch(js.in, ['browserify', 'jshint']);
    gulp.watch(php.in, ['php']);
    gulp.watch(themeDescription.in, ['themeDescription']);
    gulp.watch(themeLanguage.in, ['themeLanguage']);
});
