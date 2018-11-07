// Load Gulp...of course
var gulp         = require( 'gulp' );

// CSS related plugins
var sass         = require( 'gulp-sass' );
var autoprefixer = require( 'gulp-autoprefixer' );
var minifycss    = require( 'gulp-uglifycss' );

// JS related plugins
var uglify       = require( 'gulp-uglify' );
var babelify     = require( 'babelify' );
var browserify   = require( 'browserify' );
var source       = require( 'vinyl-source-stream' );
var buffer       = require( 'vinyl-buffer' );
var stripDebug   = require( 'gulp-strip-debug' );

// Utility plugins
var rename       = require( 'gulp-rename' );
var sourcemaps   = require( 'gulp-sourcemaps' );
var notify       = require( 'gulp-notify' );
var options      = require( 'gulp-options' );
var gulpif       = require( 'gulp-if' );

// Project related variables

var styleSRC     = './src/sass/style.sass';
var styleURL     = './assets/css/';
var mapURL       = './';

var jsSRC        = './src/scripts/';
var jsFront      = 'main.js';
var jsAdmin      = 'admin.js';
var jsFiles      = [ jsFront, jsAdmin];
var jsURL        = './assets/js/';

var styleWatch   = './src/scss/**/*.scss';
var jsWatch      = './src/scripts/**/*.js';

// Tasks
gulp.task( 'styles', function() {
    gulp.src( [ styleSRC ] )
        .pipe( sourcemaps.init() )
        .pipe( sass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }) )
        .on( 'error', console.error.bind( console ) )
        .pipe( autoprefixer({ browsers: [ 'last 2 versions', '> 5%', 'Firefox ESR' ] }) )
        .pipe( rename( { suffix: '.min' } ) )
        // .pipe( sourcemaps.write( mapURL ) )
        .pipe( gulp.dest( styleURL ) );
});

gulp.task( 'scripts', function() {
    jsFiles.map( function( entry ) {
        return browserify({
            entries: [jsSRC + entry]
        })
            .transform( babelify, { presets: [ 'env' ] } )
            .bundle()
            .pipe( source( entry ) )
            .pipe( rename( {
                extname: '.min.js'
            } ) )
            .pipe( buffer() )
            .pipe( gulpif( options.has( 'production' ), stripDebug() ) )
            .pipe( sourcemaps.init({ loadMaps: true }) )
            .pipe( uglify() )
            // .pipe( sourcemaps.write( '.' ) )
            .pipe( gulp.dest( jsURL ) );
    });
});

gulp.task( 'default', ['styles', 'scripts']);

gulp.task( 'watch', ['default'], function() {
    gulp.watch( styleWatch, [ 'styles' ] );
    gulp.watch( jsWatch, [ 'scripts'] );
});