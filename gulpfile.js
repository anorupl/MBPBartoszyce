// Defining requirements
var gulp        = require('gulp'),
	gulpIgnore  = require('gulp-ignore'),
	del         = require('del'),
	sourcemap   = require('gulp-sourcemaps'),
	sequence    = require('run-sequence'),
	sass        = require('gulp-sass'),
	compass     = require('compass-importer'),
	prefixer    = require('gulp-autoprefixer'),
	merge       = require('merge-stream'),
	imagemin    = require('gulp-imagemin'),
	changed     = require('gulp-changed'),
	svgmin      = require('gulp-svgmin'),
	uglify      = require('gulp-uglify'),
	concat      = require('gulp-concat'),
	rename      = require('gulp-rename'),
	wpPot       = require('gulp-wp-pot'),
	sort        = require('gulp-sort'),
	//ftp         = require('vinyl-ftp'),
	//ftp_config  = require('./ftp.json'),
	header      = require('gulp-header'),
	gutil       = require('gulp-util'),
	browserSync = require('browser-sync');

// Base config
var project        = 'mbp-bartoszyce', // The directory name for your theme
	node           = 'node_modules/',
	src            = './src/',
	dist           = './dist/',
	project_dir    = dist + project + '/',
	carousel       = node + 'owl.carousel/dist/owl.carousel.min.js',
	imagePopup     = node + 'magnific-popup/dist/jquery.magnific-popup.min.js';

// Config assets_js
var jquery         = node + 'jquery/dist/jquery.min.js',
	cookies        = node + 'jquery.cookie/jquery.cookie.js',
	html5shiv      = node + 'html5shiv/dist/*.min.js',
	slider         = node + 'slick-carousel/slick/slick.min.js',
	carousel       = node + 'owl.carousel/dist/owl.carousel.min.js',
	imgPopup       = node + 'magnific-popup/dist/jquery.magnific-popup.min.js';
	imgload        = node + 'imagesloaded/imagesloaded.pkgd.min.js',
	masonry        = node + 'masonry/dist/masonry.pkgd.min.js',
	jgallery       = node + 'justifiedGallery/dist/js/jquery.justifiedGallery.min.js',
	dist_assets_js = 'js/assets/';

//Config theme
var theme = {
	css: {
		src:      src + 'assets/sass/', //sass
		src_css:  src + '/css/', //css
		dist:     project_dir, //baseCss
		dist_css: project_dir + '/css/' //extraCss
	},
	image: {
		img_screen: src + '/*.{jpg,jpeg,png,gif}',
		dis_screen: project_dir,
		src:        src + 'assets/img/',
		dist:       project_dir + '/img/',
		svg_src:    src + 'assets/img/svg/',
		svg_dist:   project_dir + '/img/svg/',
		imgType:    '*.{jpg,jpeg,png,gif}'
	},
	js: {
		src:  src + 'assets/js/',
		dist: project_dir + '/js/'
	},
	php: {
		src:  src + '**/*.php', //src and watch
		dist: project_dir
	},
	customizer_assets: {
		src:  src + 'inc/customizer/assets/**/*{.js,.css,.json}', //src and watch
		dist: project_dir + '/inc/customizer/assets/'
	},
	fonts: {
		src:  src + 'assets/fonts/**/*{.ttf,.woff,.eot,.svg}', //src and watch
		dist: project_dir + '/fonts/'
	},
	lang: {
		src:  src + 'languages/**/*', //src and watch
		dist: project_dir + '/languages/'
	}
};



/////////////////////////////////////////////////////////////////////////



//Copy PHP source files to the `build` folder
gulp.task('theme-php', function() {
	return gulp.src(theme.php.src)
		.pipe(changed(theme.php.dist))
		.pipe(gulp.dest(theme.php.dist));
});


//Copy customizer assets and fonts
gulp.task('copy-assets', function() {
	//Customizer assets
	gulp.src(theme.customizer_assets.src).pipe(changed(theme.customizer_assets.dist))
		.pipe(gulp.dest(theme.customizer_assets.dist));

		//Copy all custom fonts
	gulp.src(theme.fonts.src)
		.pipe(gulp.dest(theme.fonts.dist));
});


//Generate script
gulp.task('theme-js', function() {

	//Copy Js assets: silder, html5shiv
	gulp.src([slider, html5shiv, cookies]).pipe(changed(project_dir + dist_assets_js))
		.pipe(gulp.dest(project_dir + dist_assets_js));

	//Copy Js for gallery and images
	gulp.src([imagePopup]).pipe(changed(project_dir + dist_assets_js))
		.pipe(concat('wpg-image.js')).pipe(uglify()).pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest(project_dir + dist_assets_js));

	//Copy js file
	gulp.src(theme.js.src + '**/*.min.js')
		.pipe(changed(theme.js.dist))
		.pipe(gulp.dest(theme.js.dist));

	//Copy and minify js
	gulp.src(['!' + theme.js.src + '**/*.min.js', theme.js.src + '**/*.js'])
		.pipe(changed(theme.js.dist))
		.pipe(uglify()).pipe(rename({suffix: '.min'	}))
		.pipe(gulp.dest(theme.js.dist));
});


//Build style sheets
gulp.task('sass', function() {
	//Base theme style sass
	var style = gulp.src(theme.css.src + 'style.scss')
		//.pipe(sourcemap.init())
		.pipe(changed(theme.css.dist))
		//Default:nestedValues:nested,expanded,compact,compressed
		.pipe(sass({outputStyle: 'expanded' }).on('error', sass.logError))
		//.pipe(sourcemap.write())
		.pipe(prefixer())
		.pipe(gulp.dest(theme.css.dist));
	//copy css
	var css = gulp.src(theme.css.src_css + '*.css').pipe(changed(theme.css.dist_css))
		.pipe(sass().on('error', function(error) {
			console.log(error);
			this.emit('end');
		}))
		.pipe(gulp.dest(theme.css.dist_css));
	var ie = gulp.src(theme.css.src + 'ie.scss').pipe(changed(theme.css.dist_css))
		.pipe(sass().on('error', function(error) {
			console.log(error);
			this.emit('end');
		}))
		.pipe(gulp.dest(theme.css.dist_css));
	var slick = gulp.src(theme.css.src + 'slick.scss').pipe(changed(theme.css.dist_css))
		.pipe(sass().on('error', function(error) {
			console.log(error);
			this.emit('end');
		}))
		.pipe(gulp.dest(theme.css.dist_css));
	return merge(style, css, slick, ie);
});


//Add header tag to base stylesheets
gulp.task('css', ['sass'], function() {
	return gulp.src(project_dir + 'style.css')
	.pipe(header(
'/*\n\
Theme Name: MBP Bartoszyce\n\
Theme URI: http://biblioteka.bartoszyce.pl\n\
Author: Kamil Żerebny\n\
Author URI: http://zerebny.ovh\n\
Description: Theme for MBP Bartoszyce\n\
Version: 0.1.0\n\
Licence: GPL-2.0\n\
Licence URI: http://www.gnu.org/licenses/gpl-2.0.html\n\
Tags: one-column,responsive-layout,custom-menu,featured-images,microformats,threaded-comments,translation-ready\n\
Text Domain: wpg_theme\n\
*/\n'))
	.pipe(gulp.dest(project_dir));
});


//Copy images
gulp.task('images', function() {
	var imagesFile = gulp.src(theme.image.src + '**/' + theme.image.imgType)
		.pipe(changed(theme.image.dist))
		.pipe(imagemin())
		.pipe(gulp.dest(theme.image.dist));
	var svgFile = gulp.src(theme.image.svg_src + '**/*.svg')
		.pipe(changed(theme.image.svg_dist))
		.pipe(svgmin())
		.pipe(gulp.dest(theme.image.svg_dist));
	var screenFile = gulp.src(theme.image.img_screen)
		.pipe(imagemin())
		.pipe(gulp.dest(theme.image.dis_screen));
	return merge(imagesFile, svgFile, screenFile);
});


//Copy everything under`src/languages`indiscriminately
gulp.task('theme-lang', function() {
	return gulp.src(theme.lang.dist).pipe(gulp.dest(theme.lang.dist));
});


//Generate pot-files for WordPress localization
gulp.task('language', function() {
	var langpot = gulp.src(theme.php.src)
		.pipe(sort()).pipe(wpPot({
			domain: 'wpg_theme',
			destFile: 'mbp-bartoszyce.pot',
			package: 'MBP Bartoszyce',
			bugReport: 'http://biblioteka.bartoszyce.pl'
		}))
		.pipe(gulp.dest(theme.lang.dist));
	var langpo = gulp.src(theme.lang.src)
		.pipe(gulp.dest(theme.lang.dist));
	return merge(langpot, langpo);
});



//////////////////////Build////////////////////////////////////////////////



//Remove distributon folder
gulp.task('clean', function() {
	return del(dist);
});
gulp.task('build', ['clean'], function() {
	sequence('theme-php', 'copy-assets', 'theme-lang', 'theme-js', 'css', 'images', 'language');
});



//////////////////////Watch////////////////////////////////////////////////



gulp.task('watch-all', function() {
	//1.Copy PHP source files to the `build`folder
	gulp.watch(theme.php.src, ['theme-php']);
	//2.Copy customizer assets and fonts
	gulp.watch(theme.customizer_assets.src, ['copy-assets']);
	//3.Copy customizer assets and fonts
	gulp.watch(theme.fonts.src, ['copy-assets']);
	//4.Copy everything under `src/languages`indiscriminately
	gulp.watch(theme.lang.src, ['theme-lang']);
	//6.Generate script theme js
	gulp.watch(theme.js.src + '**/*.js', ['theme-js']);
	//7.Build stylesheets
	gulp.watch(theme.css.src + '/**/*.scss', ['css']);
	//8.Copy images
	gulp.watch([theme.image.src + '**/' + theme.image.imgType, theme.image.svg_src + '**/*.svg'], ['image']);
});


gulp.task('watch-code', function() {
	//Copy PHP source files to the `build`folder
	gulp.watch(theme.php.src, ['theme-php']);
	//Copy customizer assets and fonts
	gulp.watch(theme.customizer_assets.src, ['copy-assets']);
	//Generate script theme js
	gulp.watch([node + '*/{' + dist + '**/*.js,' + dist + '*.js}'], ['theme-js']);
	//Generate script theme js
	gulp.watch(theme.js.src + '**/*.js', ['theme-js']);
	//Build stylesheets
	gulp.watch(theme.css.src + '/**/*.scss', ['css']);
});


gulp.task('watcha', function() {
	//Copy PHP source files to the `build`folder
	gulp.watch(theme.php.src, ['theme-php']);
	//Build stylesheets
	gulp.watch(theme.css.src + '/**/*.scss', ['css']);
	//gulp.watch(theme.js.src+'**/*.js',['theme-js']);
});



//////////////////////FTP////////////////////////////////////////////////



gulp.task('ftp', function() {
	var conn = ftp.create({
		host: ftp_config.host,
		user: ftp_config.user,
		password: ftp_config.password,
		parallel: 10,
		log: gutil.log
	});
	return gulp.src(dist + '**', {
		base: dist,
		buffer: false
	}).pipe(conn.newer(ftp_config.path)).pipe(conn.dest(ftp_config.path));
});


gulp.task('ftp-watch', function() {
	var conn = ftp.create({
		host: ftp_config.host,
		user: ftp_config.user,
		password: ftp_config.password,
		parallel: 10,
		log: gutil.log
	});
	//Copy PHP source files to the `build`folder
	gulp.watch(theme.php.src, ['theme-php']);
	//Build stylesheets
	gulp.watch(theme.css.src + '/**/*.scss', ['css']);
	//Watch dist
	gulp.watch(['./dist/**/*']).on('change', function(event) {
		console.log('Changesdetected!Uploadingfile"' + event.path + '",' + event.type);
		return gulp.src([event.path], {
			base: dist,
			buffer: false
		}).pipe(conn.newer(ftp_config.path)).pipe(conn.dest(ftp_config.path));;
	});
});
