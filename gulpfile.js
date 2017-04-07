// jscs:disable
/* jshint asi:true, esversion:6 */
/* global require:false */
// Grab our gulp packages
var gulp        = require( 'gulp' ),
    gutil       = require( 'gulp-util' ),
    debug       = require( 'gulp-debug' ),
    sass        = require( 'gulp-sass' ),
    sassdoc     = require( 'sassdoc' ),
    postcss     = require( 'gulp-postcss' ),
    cssnano     = require( 'gulp-cssnano' ),
    sourcemaps  = require( 'gulp-sourcemaps' ),
    jshint      = require( 'gulp-jshint' ),
    jscs        = require( 'gulp-jscs' ),
    stylish     = require( 'jshint-stylish' ),
    jscsStylish = require( 'jscs-stylish' ).path,
    uglify      = require( 'gulp-uglify' ),
    concat      = require( 'gulp-concat' ),
    stripDebug  = require( 'gulp-strip-debug' ),
    rename      = require( 'gulp-rename' ),
    plumber     = require( 'gulp-plumber' ),
    bower       = require( 'gulp-bower' ),
    babel       = require( 'gulp-babel' ),
    phpcs       = require( 'gulp-phpcs' ),
    browserSync = require( 'browser-sync' ).create(),
    notify      = require( 'gulp-notify' ),
    changed     = require( 'gulp-changed' ),
    del         = require( 'del' ),
    wpPot       = require( 'gulp-wp-pot' ),
    sort        = require( 'gulp-sort' ),
    checktextdomain = require( 'gulp-checktextdomain' );

// Translation related.
const text_domain = 'bigwing-nest'; // Your textdomain here.
const destFile = 'nest-starter-theme.pot'; // Name of the translation file.
const packageName = 'nest-starter-theme'; // Package name.
const bugReport = 'https://bigwing.com/contact/'; // Where can users report bugs.
const lastTranslator = 'BigWing Interactive <wordpress@bigwing.com>'; // Last translator Email ID.
const team = 'BigWing Interactive <wordpress@bigwing.com>'; // Team's Email ID.
const translatePath = './languages';// Where to save the translation files.

// Set asset paths.
var paths = {
	css: ['assets/css/*.css', '!assets/css/*.min.css'],
	sass: 'assets/scss/**/*.scss',
	js: {
		src: 'assets/js/scripts/**/*.js',
		dest: 'assets/js'
	},
	php: ['*.php', 'assets/**/*.php', 'parts/**/*.php']
};

// Gets info from currently running task
gulp.Gulp.prototype.__runTask = gulp.Gulp.prototype._runTask;
gulp.Gulp.prototype._runTask = function ( task ) {
	this.currentTask = task;
	this.__runTask( task );
};

/**
 * Checks to see if we're in a development environment.
 *
 * @requires 'gulp-util'
 *
 * @returns {boolean}
 */
var isDev = function isDev() {
	return ( (typeof gutil.env.type !== 'undefined') && (gutil.env.type === 'development'));
};

/**
 * Handle errors.
 */
function handleErrors() {
	var args = Array.prototype.slice.call( arguments );
	notify.onError( {
		title: 'Task Failed [<%= error.message %>',
		message: 'See console.',
		sound: 'Sosumi'
	} ).apply( this, args );
	gutil.beep();
	this.emit( 'end' );
}

gulp.task( 'styles:sass', function () {
	return gulp.src( paths.sass )
		.pipe( plumber( { errorHandler: handleErrors } ) )
		.pipe( sass( {
			outputStyle: 'expanded',
			sourceComments: 'normal',
			errLogToConsole: true
		} ) )
		.pipe( gulp.dest( './assets/css/' ) )
} );

gulp.task( 'styles:postcss', ['styles:sass'], function () {
	var unprefix          = require( 'postcss-unprefix' ),
	    flexboxfixer      = require( 'postcss-flexboxfixer' ),
	    gradientfixer     = require( 'postcss-gradientfixer' ),
	    transparencyfixer = require( 'postcss-gradient-transparency-fix' ),
	    mqpacker          = require( 'css-mqpacker' ),
	    autoprefixer      = require( 'autoprefixer' );

	var processors = [
		unprefix,
		autoprefixer,
		mqpacker( { sort: true } ),
		flexboxfixer,
		gradientfixer,
		transparencyfixer
	];

	return gulp.src( ['./assets/css/*.css', '!./assets/css/*.min.css'] )
		.pipe( plumber( { errorHandler: handleErrors } ) )
		.pipe( isDev() ? debug( { title: 'postcss:' } ) : gutil.noop() )
		.pipe( postcss( processors ) )
		.pipe( gulp.dest( './assets/css/' ) )
} );

gulp.task( 'styles:minify', ['styles:postcss'], function () {
	return isDev() ? gutil.noop() :
	       gulp.src( paths.css )
		       .pipe( plumber( { errorHandler: handleErrors } ) )
		       .pipe( isDev() ? debug( { title: this.currentTask.name } ) : gutil.noop() )
		       .pipe( sourcemaps.init() )
		       .pipe( cssnano( { safe: true } ) )
		       .pipe( rename( { suffix: '.min' } ) )
		       .pipe( sourcemaps.write( '.' ) )
		       .pipe( gulp.dest( './assets/css/' ) );
} );

// Generate Sass documentation
gulp.task( 'sassdoc', function () {
	var options = {
		dest: 'docs/sass',
		verbose: false,
		groups: {
			'undefined': 'Ungrouped',
			'typography': 'Typography'
		}
	};
	return gulp.src( paths.sass )
		.pipe( sassdoc( options ) );
} );

gulp.task( 'js:lint', function () {
	return gulp.src( paths.js.src )
		.pipe( jshint() )
		.pipe( jshint.reporter( stylish ) )
		.pipe( jscs() )
		.pipe( jscs.reporter( jscsStylish ) )
} );

// JSHint, concat, and minify JavaScript
gulp.task( 'js:site', function () {
	return gulp.src( paths.js.src )
		.pipe( plumber( { errorHandler: handleErrors } ) )
		.pipe( sourcemaps.init() )
		.pipe( babel( {
			presets: ['env'],
			compact: false
		} ) )
		.pipe( concat( 'scripts.js' ) )
		.pipe( gulp.dest( paths.js.dest ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( stripDebug() )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( paths.js.dest ) )
} );

// JSHint, concat, and minify Foundation JavaScript
gulp.task( 'js:foundation', function () {
	return gulp.src( [

		// Foundation core - needed if you want to use any of the components below
		'./bower_components/foundation-sites/js/foundation.core.js',
		'./bower_components/foundation-sites/js/foundation.util.*.js',

		// Pick the components you need in your project
		'./bower_components/foundation-sites/js/foundation.abide.js',
		'./bower_components/foundation-sites/js/foundation.accordion.js',
		'./bower_components/foundation-sites/js/foundation.accordionMenu.js',
		'./bower_components/foundation-sites/js/foundation.drilldown.js',
		'./bower_components/foundation-sites/js/foundation.dropdown.js',
		'./bower_components/foundation-sites/js/foundation.dropdownMenu.js',
		'./bower_components/foundation-sites/js/foundation.equalizer.js',
		'./bower_components/foundation-sites/js/foundation.interchange.js',
		'./bower_components/foundation-sites/js/foundation.magellan.js',
		'./bower_components/foundation-sites/js/foundation.offcanvas.js',
		'./bower_components/foundation-sites/js/foundation.orbit.js',
		'./bower_components/foundation-sites/js/foundation.responsiveMenu.js',
		'./bower_components/foundation-sites/js/foundation.responsiveToggle.js',
		'./bower_components/foundation-sites/js/foundation.reveal.js',
		'./bower_components/foundation-sites/js/foundation.slider.js',
		'./bower_components/foundation-sites/js/foundation.sticky.js',
		'./bower_components/foundation-sites/js/foundation.tabs.js',
		'./bower_components/foundation-sites/js/foundation.toggler.js',
		'./bower_components/foundation-sites/js/foundation.tooltip.js',
		'./bower_components/foundation-sites/js/foundation.util.motion.js'
	] )
		.pipe( changed( paths.js.dest ) )
		.pipe( babel( {
			presets: ['es2015'],
			compact: true
		} ) )
		.pipe( sourcemaps.init() )
		.pipe( concat( 'foundation.js' ) )
		.pipe( gulp.dest( './assets/js' ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '.' ) ) // Creates sourcemap for minified Foundation JS
		.pipe( gulp.dest( paths.js.dest ) )
} );

gulp.task( 'js:what-input', function () {
	return gulp.src( './bower_components/what-input/dist/what-input.js' )
		.pipe( changed( paths.js.dest ) )
		.pipe( sourcemaps.init() )
		.pipe( concat( 'what-input.js' ) )
		.pipe( gulp.dest( './assets/js' ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( paths.js.dest ) )
} );

gulp.task( 'js:gallery', function () {
	return gulp.src( './bower_components/jquery-carouFredSel/jquery.carouFredSel-6.2.1.js' )
		.pipe( changed( paths.js.dest ) )
		.pipe( sourcemaps.init() )
		.pipe( concat( 'caroufredsel.js' ) )
		.pipe( gulp.dest( paths.js.dest ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( paths.js.dest ) )
} );

gulp.task( 'js:retinajs', function () {
	return gulp.src( './bower_components/retinajs/dist/retina.js' )
		.pipe( changed( paths.js.dest ) )
		.pipe( sourcemaps.init() )
		.pipe( concat( 'retina.js' ) )
		.pipe( gulp.dest( paths.js.dest ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglify() )
		.pipe( sourcemaps.write() )
		.pipe( gulp.dest( paths.js.dest ) )
} );

gulp.task( 'styles:retinajs', function () {
	return gulp.src( './bower_components/retinajs/dist/_retina.scss' )
		.pipe( gulp.dest( './assets/scss/_mixins' ) )
} );

// Update Foundation with Bower and save to /bower_components
gulp.task( 'bower', function () {
	return bower( { cmd: 'update' } )
} );

// Browser-Sync watch files and inject changes
gulp.task( 'browsersync', function () {
	// Watch files
	var files = [
		'./assets/css/*.css',
		'./assets/js/*.js',
		'**/*.php',
		'assets/images/**/*.{png,jpg,gif,svg,webp}',
	];

	browserSync.init( files, {
		// Replace with URL of your local site
		proxy: 'https://bigwing.local/'
	} );

	gulp.watch( paths.sass, ['styles'] );
	gulp.watch( paths.js.src, ['site-js'] ).on( 'change', browserSync.reload );

} );

// Watch files for changes (without Browser-Sync)
gulp.task( 'watch', function () {

	// Watch .scss files
	gulp.watch( paths.sass, ['styles'] );

	// Watch site-js files
	gulp.watch( paths.js.src, ['js:site'] );

	// Watch foundation-js files
	gulp.watch( './bower_components/foundation-sites/js/*.js', ['js:foundation'] );

	gulp.watch( paths.php, ['phpcs'] );

} );

gulp.task( 'phpcs', function () {
	return gulp.src( paths.php )
		.pipe( phpcs( {
			bin: (true === gutil.env.fix) ? 'vendor/bin/phpcbf' : 'vendor/bin/phpcs',
			colors: true
		} ) )
		.pipe( phpcs.reporter( 'log' ) )
} );


/**
 * WP POT Translation File Generator.
 *
 * * This task does the following:
 *     1. Gets the source of all the PHP files
 *     2. Sort files in stream by path or any custom sort comparator
 *     3. Applies wpPot with the variable set at the top of this file
 *     4. Generate a .pot file of i18n that can be used for l10n to build .mo file
 */
gulp.task( 'translate', ['checktextdomain'], function () {
	return gulp.src( paths.php )
		.pipe( sort() )
		.pipe( wpPot( {
			domain: text_domain,
			destFile: destFile,
			package: packageName,
			//bugReport: bugReport,
			lastTranslator: lastTranslator,
			team: team
		} ) )
		.pipe( gulp.dest( translatePath + '/' + destFile ) )
		.pipe( notify( { message: 'TASK: "translate" Completed! 💯', onLast: true } ) )

} );

gulp.task( 'checktextdomain', function () {
	return gulp.src( paths.php )
		.pipe( checktextdomain( {
			text_domain: text_domain, //Specify allowed domain(s)
			keywords: [ //List keyword specifications
				'__:1,2d',
				'_e:1,2d',
				'_x:1,2c,3d',
				'esc_html__:1,2d',
				'esc_html_e:1,2d',
				'esc_html_x:1,2c,3d',
				'esc_attr__:1,2d',
				'esc_attr_e:1,2d',
				'esc_attr_x:1,2c,3d',
				'_ex:1,2c,3d',
				'_n:1,2,4d',
				'_nx:1,2,4c,5d',
				'_n_noop:1,2,3d',
				'_nx_noop:1,2,3c,4d'
			],
			correct_domain: true,
		} ) );
} );

/**
 * Clean compiled files.
 */
gulp.task( 'clean:styles', function () {
	return del( 'assets/css' )
} );

gulp.task( 'clean:scripts', function () {
	return del( 'assets/js/*.{js,map}' )
} );

gulp.task( 'default', ['styles', 'scripts', 'lint'] );

gulp.task( 'build', ['bower', 'clean'], function () {
	gulp.start( ['scripts', 'styles'] );
} );

gulp.task( 'styles', ['clean:styles'], function () {
	gulp.start( ['styles:retinajs', 'styles:sass', 'styles:postcss', 'styles:minify'] );
} );

gulp.task( 'scripts', ['clean:scripts'], function () {
	gulp.start( ['js:site', 'js:foundation', 'js:what-input', 'js:gallery'] );
} );

gulp.task( 'lint', ['js:lint', 'phpcs'] );
gulp.task( 'clean', ['clean:styles', 'clean:scripts'] );
