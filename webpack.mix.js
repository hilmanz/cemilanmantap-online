let mix = require('laravel-mix');

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
mix.styles('public/front_assets/assets/css/cm2018.css', 'public/front_assets/assets/css/cm2018.min.css');
mix.styles('public/front_assets/assets/css/custom.css', 'public/front_assets/assets/css/custom.min.css');

mix.styles('public/back_assets/css/theme-default.css', 'public/back_assets/css/theme-default.min.css');
mix.js('public/back_assets/js/scripts/dashboard_index.js', 'public/back_assets/js/scripts/dashboard_index.min.js');
mix.js('public/back_assets/js/scripts/categories_data_edit.js', 'public/back_assets/js/scripts/categories_data_edit.min.js');
mix.js('public/back_assets/js/scripts/categories_index.js', 'public/back_assets/js/scripts/categories_index.min.js');
mix.js('public/back_assets/js/scripts/categories_abjad_data_edit.js', 'public/back_assets/js/scripts/categories_abjad_data_edit.min.js');
mix.js('public/back_assets/js/scripts/categories_abjad_index.js', 'public/back_assets/js/scripts/categories_abjad_index.min.js');
mix.js('public/back_assets/js/scripts/home_sliders_data_edit.js', 'public/back_assets/js/scripts/home_sliders_data_edit.min.js');
mix.js('public/back_assets/js/scripts/home_sliders_index.js', 'public/back_assets/js/scripts/home_sliders_index.min.js');
mix.js('public/back_assets/js/scripts/media_data_edit.js', 'public/back_assets/js/scripts/media_data_edit.min.js');
mix.js('public/back_assets/js/scripts/media_index.js', 'public/back_assets/js/scripts/media_index.min.js');
mix.js('public/back_assets/js/scripts/media_list.js', 'public/back_assets/js/scripts/media_list.min.js');
mix.js('public/back_assets/js/scripts/media_list_modal.js', 'public/back_assets/js/scripts/media_list_modal.min.js');
mix.js('public/back_assets/js/scripts/media_list_multiple_modal.js', 'public/back_assets/js/scripts/media_list_multiple_modal.min.js');
mix.js('public/back_assets/js/scripts/modal_z_index.js', 'public/back_assets/js/scripts/modal_z_index.min.js');
mix.js('public/back_assets/js/scripts/roles_add.js', 'public/back_assets/js/scripts/roles_add.min.js');
mix.js('public/back_assets/js/scripts/roles_index.js', 'public/back_assets/js/scripts/roles_index.min.js');
mix.js('public/back_assets/js/scripts/roles_select2.js', 'public/back_assets/js/scripts/roles_select2.min.js');
mix.js('public/back_assets/js/scripts/users_index.js', 'public/back_assets/js/scripts/users_index.min.js');
mix.js('public/back_assets/js/scripts/stores_data_edit.js', 'public/back_assets/js/scripts/stores_data_edit.min.js');
mix.js('public/back_assets/js/scripts/stores_index.js', 'public/back_assets/js/scripts/stores_index.min.js');
mix.js('public/back_assets/js/scripts/videos_index.js', 'public/back_assets/js/scripts/videos_index.min.js');
mix.js('public/back_assets/js/scripts/videos_data_edit.js', 'public/back_assets/js/scripts/videos_data_edit.min.js');
mix.js('public/back_assets/js/scripts/foods_index.js', 'public/back_assets/js/scripts/foods_index.min.js');
mix.js('public/back_assets/js/scripts/foods_data_edit.js', 'public/back_assets/js/scripts/foods_data_edit.min.js');
mix.js('public/back_assets/js/scripts/comments_index.js', 'public/back_assets/js/scripts/comments_index.min.js');
mix.js('public/back_assets/js/scripts/referensi_cemilan_index.js', 'public/back_assets/js/scripts/referensi_cemilan_index.min.js');

mix.js('public/front_assets/assets/js/kategori/food.js', 'public/front_assets/assets/js/kategori/food.min.js');
mix.js('public/front_assets/assets/js/add_cemilan/add_cemilan.js', 'public/front_assets/assets/js/add_cemilan/add_cemilan.min.js');
mix.js('public/front_assets/assets/js/session_info/user_info.js', 'public/front_assets/assets/js/session_info/user_info.min.js');
mix.js('public/front_assets/assets/js/custom.js', 'public/front_assets/assets/js/custom.min.js');
mix.js('public/front_assets/assets/js/cm2018.js', 'public/front_assets/assets/js/cm2018.min.js');
mix.version();

mix.browserSync({
    proxy: 'cemilanmantap.com'
});

