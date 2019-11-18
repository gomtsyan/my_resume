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
//**ADMIN**//
//Admin App
    .scripts([
        'public/admin-public/js/subview.js',
        'public/admin-public/js/main.js',
        'public/admin-public/js/dialog-boxes.js',
        'public/admin-public/js/main-init.js'
    ], 'public/js/admin/app.js')
    .styles([
        'public/admin-public/css/styles.css',
        'public/admin-public/css/styles-responsive.css',
        'public/admin-public/css/plugins.css',
        'public/admin-public/css/theme-style.css',
    ], 'public/css/admin/app.css')
    //Admin Articles page
    .scripts([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
        'node_modules/bootstrap-switch/dist/js/bootstrap-switch.js',
        'public/admin-public/plugins/select2/select2.js',
        'public/admin-public/plugins/ckeditor/ckeditor.js',
        'public/admin-public/js/ui-buttons.js',
        'public/admin-public/js/form-elements.js',
        'public/admin-public/js/articles-init.js'
    ], 'public/js/admin/adminArticles.js')
    .styles([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.css',
        'public/admin-public/plugins/select2/select2.css',
        'node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css'
    ], 'public/css/admin/adminArticles.css')
    //Admin index page
    .scripts([
        'public/admin-public/plugins/moment/moment.js',
        'public/admin-public/plugins/bootstrap-daterangepicker/daterangepicker.js',
        'node_modules/nvd3/lib/d3.v3.js',
        'node_modules/nvd3/nv.d3.js',
        'node_modules/jquery-sparkline/jquery.sparkline.js',
        'public/admin-public/js/index.js',
        'public/admin-public/js/index-init.js'
    ], 'public/js/admin/adminIndex.js')
    .styles([
        'public/admin-public/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
        'node_modules/nvd3/nv.d3.css'
    ], 'public/css/admin/adminIndex.css')
    //Admin Contacts Page
    .scripts([
        'node_modules/bootstrap-select/dist/js/bootstrap-select.js',
        'node_modules/bootstrap-switch/dist/js/bootstrap-switch.js',
        'public/admin-public/js/ui-buttons.js',
        'public/admin-public/js/ui-buttons-init.js'
    ], 'public/js/admin/adminContacts.js')
    .styles([
        'node_modules/bootstrap-select/dist/css/bootstrap-select.css',
        'node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css'
    ], 'public/css/admin/adminContacts.css')
    //Admin Education Page
    .scripts([
        'public/admin-public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
        'public/admin-public/js/admin-date-form.js',
        'public/admin-public/js/admin-date-form-init.js'
    ], 'public/js/admin/adminEducation.js')
    .styles([
        'public/admin-public/plugins/bootstrap-datepicker/css/datepicker.css'
    ], 'public/css/admin/adminEducation.css')
    //Admin Experiences Page
    .scripts([
        'public/admin-public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
        'public/admin-public/js/admin-date-form.js',
        'public/admin-public/js/admin-date-form-init.js'
    ], 'public/js/admin/adminExperiences.js')
    .styles([
        'public/admin-public/plugins/bootstrap-datepicker/css/datepicker.css'
    ], 'public/css/admin/adminExperiences.css')
    //Admin Language Skills Page
    .scripts([
        'public/admin-public/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
        'public/admin-public/js/touch-spin.js',
        'public/admin-public/js/touch-spin-init.js'
    ], 'public/js/admin/adminLanguageSkills.js')
    .styles([
        'public/admin-public/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css'
    ], 'public/css/admin/adminLanguageSkills.css')
    //Admin Messages Page
    .scripts([
        'public/admin-public/js/ui-messages.js',
        'public/admin-public/js/ui-messages-init.js'
    ], 'public/js/admin/adminMessages.js')
    //Admin Pages Page
    .scripts([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
        'node_modules/bootstrap-switch/dist/js/bootstrap-switch.js',
        'public/admin-public/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
        'public/admin-public/js/touch-spin.js',
        'public/admin-public/js/ui-buttons.js',
        'public/admin-public/js/pages-init.js'
    ], 'public/js/admin/adminPages.js')
    .styles([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.css',
        'node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css',
        'public/admin-public/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css'
    ], 'public/css/admin/adminPages.css')
    //Admin Personal Info Page
    .scripts([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.js'
    ], 'public/js/admin/adminPersonalInfo.js')
    .styles([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.css'
    ], 'public/css/admin/adminPersonalInfo.css')
    //Admin Portfolio Page
    .scripts([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.js'
    ], 'public/js/admin/adminPortfolio.js')
    .styles([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.css'
    ], 'public/css/admin/adminPortfolio.css')
    //Admin Profile Page
    .scripts([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
        'public/admin-public/plugins/ckeditor/ckeditor.js'
    ], 'public/js/admin/adminProfile.js')
    .styles([
        'public/admin-public/plugins/bootstrap-fileupload/bootstrap-fileupload.css'
    ], 'public/css/admin/adminProfile.css')
    //Admin Settings Page
    .scripts([
        'public/admin-public/plugins/select2/select2.js',
        'public/admin-public/plugins/x-editable/js/bootstrap-editable.js',
        'public/admin-public/plugins/x-editable/demo-mock.js',
        'public/admin-public/plugins/x-editable/demo.js',
        'public/admin-public/js/form-elements.js',
        'public/admin-public/js/form-elements-init.js'
    ], 'public/js/admin/adminSettings.js')
    .styles([
        'public/admin-public/plugins/select2/select2.css',
        'public/admin-public/plugins/x-editable/css/bootstrap-editable.css'
    ], 'public/css/admin/adminSettings.css')
    //Admin Skills Page
    .scripts([
        'public/admin-public/plugins/select2/select2.js',
        'public/admin-public/js/form-elements.js',
        'public/admin-public/js/form-elements-init.js'
    ], 'public/js/admin/adminSkills.js')
    .styles([
        'public/admin-public/plugins/select2/select2.css',
    ], 'public/css/admin/adminSkills.css')
    //Admin Users Page
    .scripts([
        'public/admin-public/plugins/select2/select2.js',
        'public/admin-public/js/form-elements.js',
        'public/admin-public/js/form-elements-init.js'
    ], 'public/js/admin/adminUsers.js')
    .styles([
        'public/admin-public/plugins/select2/select2.css',
    ], 'public/css/admin/adminUsers.css')
    //Admin Visitors Page
    .scripts([
        'public/admin-public/plugins/leaflet/leaflet.js',
        'public/admin-public/plugins/DataTables/media/js/datatables.js',
        'public/admin-public/plugins/DataTables/media/js/DT_bootstrap.js',
        'public/admin-public/plugins/select2/select2.js',
        'public/admin-public/js/form-elements.js',
        'public/admin-public/js/ui-subview.js',
        'public/admin-public/js/table-data.js',
        'public/admin-public/js/visitors-init.js'
    ], 'public/js/admin/adminVisitors.js')
    .styles([
        'public/admin-public/plugins/leaflet/leaflet.css',
        'public/admin-public/plugins/select2/select2.css',
        'public/admin-public/plugins/DataTables/media/css/DT_bootstrap.css',
    ], 'public/css/admin/adminVisitors.css')
    //Admin Vendor
    .js('resources/js/adminVendor.js', 'public/js')
    .sass('resources/sass/adminVendor.scss', 'public/css')
    //**LOGIN**//
    .scripts([
        'public/admin-public/js/jquery.validate.min.js',
        'public/admin-public/js/login.js',
        'public/admin-public/js/login-init.js'
    ], 'public/js/admin/authLogin.js')
    //**SITE**//
    //Site App
    .scripts([
        'public/site/js/prefixfree.min.js',
        'public/site/js/modernizr.js',
        'public/site/js/scripts.js'
    ], 'public/js/site/app.js')
    .styles([
        'public/site/css/component.css',
        'public/site/css/contact.form.css',
        'public/site/css/style.css',
        'public/site/css/respons.css',
    ], 'public/css/site/app.css')
    //Site Resume Page
    .scripts([
        'public/site/js/jquery.mixitup.min.js',
        'public/site/js/jquery.ratyli.js',
        'public/site/js/resume_scripts.js'
    ], 'public/js/site/resumeScripts.js')
    //Site Portfolio Page
    .scripts([
        'public/site/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
        'public/site/plugins/fancybox/source/jquery.fancybox.js',
        'public/site/plugins/fancybox/source/helpers/jquery.fancybox-buttons.js',
        'public/site/js/portfolio_scripts.js'
    ], 'public/js/site/portfolioScripts.js')
    .styles([
        'public/site/plugins/fancybox/source/helpers/jquery.fancybox-buttons.css',
        'public/site/plugins/fancybox/source/jquery.fancybox.css',
    ], 'public/css/site/portfolioStyles.css')
    //Site Article Page
    .scripts([
        'public/site/js/comment-reply.js'
    ], 'public/js/site/articleScripts.js')
    //Site Vendor
    .js('resources/js/siteVendor.js', 'public/js')
    .sass('resources/sass/siteVendor.scss', 'public/css')

    //**COPY FILES**//
    .copy('public/admin-public/plugins/leaflet/images', 'public/images/leaflet')
    .copy('public/admin-public/plugins/DataTables/media/images', 'public/images/datatables')
    .copy('public/admin-public/plugins/select2/select2.png', 'public/css/admin');
