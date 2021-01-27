const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    /** assets web */
    .sass('resources/views/web/assets/scss/bootstrap_person.scss', 'public/web/assets/css/bootstrap.css')

    .styles([
        'resources/views/web/assets/libs/lightbox/ekko-lightbox.css'
    ],'public/web/assets/libs/libs.css')

    .sass('resources/views/web/assets/scss/app.scss', 'public/web/assets/css/app.css')

    .scripts([
        'resources/views/web/assets/js/jquery-3.3.1.min.js'
    ], 'public/web/assets/js/jquery.js')

    .scripts([
        'node_modules/bootstrap/dist/js/bootstrap.bundle.js'
    ], 'public/web/assets/js/bootstrap.bundle.js')

    .scripts([
        'resources/views/web/assets/libs/lightbox/ekko-lightbox.min.js'
    ], 'public/web/assets/libs/lightbox/ekko-lightbox.min.js')

    .scripts([
        'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js',
        'node_modules/bootstrap-select/dist/js/i18n/defaults-pt_BR.min.js',
    ], 'public/web/assets/js/libs.js')

    .scripts([
        'resources/views/web/assets/js/scripts.js'
    ], 'public/web/assets/js/scripts.js')

    .copyDirectory('resources/views/web/assets/css/fonts', 'public/web/assets/css/fonts')
    .copyDirectory('resources/views/web/assets/images', 'public/web/assets/images')
    .copyDirectory('resources/views/web/properties', 'public/web/properties')

    /** assets admin */
    .sass('resources/views/admin/assets/scss/reset.scss', 'public/backend/assets/css/reset.css')
    .sass('resources/views/admin/assets/scss/boot.scss', 'public/backend/assets/css/boot.css')
    .sass('resources/views/admin/assets/scss/login.scss', 'public/backend/assets/css/login.css')
    .sass('resources/views/admin/assets/scss/style.scss', 'public/backend/assets/css/style.css')

    .styles([
        'resources/views/admin/assets/js/datatables/css/jquery.dataTables.min.css',
        'resources/views/admin/assets/js/datatables/css/responsive.dataTables.min.css',
        'resources/views/admin/assets/js/select2/css/select2.min.css',
    ], 'public/backend/assets/css/libs.css')

    .scripts([
        'resources/views/admin/assets/js/jquery.min.js'
    ], 'public/backend/assets/js/jquery.js')
    .scripts([
        'resources/views/admin/assets/js/login.js'
    ], 'public/backend/assets/js/login.js')

    .scripts([
        'resources/views/admin/assets/js/datatables/js/jquery.dataTables.min.js',
        'resources/views/admin/assets/js/datatables/js/dataTables.responsive.min.js',
        'resources/views/admin/assets/js/select2/js/select2.min.js',
        'resources/views/admin/assets/js/select2/js/i18n/pt-BR.js',
        'resources/views/admin/assets/js/jquery.form.js',
        'resources/views/admin/assets/js/jquery.mask.js',
    ], 'public/backend/assets/js/libs.js')

    .scripts([
        'resources/views/admin/assets/js/scripts.js'
    ], 'public/backend/assets/js/scripts.js')

    .copyDirectory('resources/views/admin/assets/js/datatables', 'public/backend/assets/js/datatables')
    .copyDirectory('resources/views/admin/assets/js/select2', 'public/backend/assets/js/select2')
    .copyDirectory('resources/views/admin/assets/js/tinymce', 'public/backend/assets/js/tinymce')

    .copyDirectory('resources/views/admin/assets/images', 'public/backend/assets/images')

    .options({
        processCssUrls: false
    })

    .version()
;
