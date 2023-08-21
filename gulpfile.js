// --> Gulp padrão
const gulp = require('gulp');

// --> Css Sass
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const purgecss = require('gulp-purgecss');
sass.compiler = require('node-sass');

// --> JavaScript
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

// -->Img
const image = require('gulp-image');
const webp = require('gulp-webp');

// --> Exportando 
exports.css = css;
exports.js = js;
exports.jsCore = jsCore;
exports.jsConcat = jsConcat;
exports.img = img;
exports.imgWebp = imgWebp;
exports.watch = watch;
exports.sassComp = sassComp;
exports.default = gulp.parallel(watch, sassComp, css, jsCore, js, jsConcat, img, imgWebp);


/* -------------------------------- CSS/SASS -------------------------------- */
function sassComp() {
  return gulp.src('assets/build/css/scss/**/*.scss')
    .pipe(sass({
      outputStyle: 'compressed'
    }))
    .pipe(gulp.dest('assets/build/css'))
}

function css() {
  return gulp.src(['assets/build/css/plugins/*.css', 'build/css/*.css'])
    .pipe(concat('all.min.css'))
    .pipe(purgecss({
      content: ['application/views/**/*.php'],
      whitelist: []
    }))
    .pipe(cleanCSS({
      debug: true
    }, (details) => {
      console.log(`${details.name}: ${details.stats.originalSize}`);
      console.log(`${details.name}: ${details.stats.minifiedSize}`);
    }))
    .pipe(gulp.dest('assets/dist/css'));
}


/* ------------------------------- JAVASCRIPT ------------------------------- */
function jsCore() {
  return gulp.src(['assets/build/js/core/jquery.min.js',
      'assets/build/js/core/popper.min.js',
      'assets/build/js/core/bootstrap.min.js',
      'assets/build/js/plugin/*.js'
    ])
    .pipe(concat('corePlugins.all.js'))
    .pipe(gulp.dest('assets/build/js'))
}

function js() {
  return gulp.src(['assets/build/js/app.js',
      'assets/build/js/tabelas.js'
    ])
    .pipe(concat('all.js'))
    .pipe(babel({
      presets: ['env']
    }))
    .pipe(uglify())
    .pipe(gulp.dest('assets/build/js'))
}

function jsConcat() {
  return gulp.src(['assets/build/js/corePlugins.all.js',
      'assets/build/js/all.js',
    ])
    .pipe(concat('all.min.js'))
    .pipe(gulp.dest('assets/dist/js'))
}


/* --------------------------------- IMAGENS -------------------------------- */
function img() {
  return gulp.src('assets/build/img/**/*')
    .pipe(image())
    .pipe(gulp.dest('assets/dist/img/img-otimizadas'));
}

function imgWebp() {
  return gulp.src('assets/dist/img/img-otimizadas/**/*')
    .pipe(webp())
    .pipe(gulp.dest('assets/dist/img/webp'));
}

/* ---------------------------------- WATCH --------------------------------- */
function watch() {
  gulp.watch('assets/build/css/scss/**/*.scss', sassComp);
  gulp.watch('assets/build/css/style.css', css);
  //gulp.watch('assets/build/js/**/*.js', js);
  gulp.watch('assets/build/img/**/*', img, );
  gulp.watch('assets/dist/img/img-otimizadas', imgWebp);
}