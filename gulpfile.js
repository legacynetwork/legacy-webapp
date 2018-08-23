var gulp        = require('gulp');
var browserSync = require('browser-sync').create();

// Static server
gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });
});

gulp.task('default', function() {
    browserSync.init({
        notify: false,
        proxy: "localhost:8008"
    });
    gulp.watch(['./**/*.{scss,css,html,py,js}'], reload);
});

// or...

// gulp.task('browser-sync', function() {
//     browserSync.init({
//         proxy: "yourlocal.dev"
//     });
// });
