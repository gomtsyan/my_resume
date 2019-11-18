<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('index');

Route::get('profile', 'ProfileController@index')->name('profile');

Route::get('download/{file}', 'FileController@download')->name('download');

Route::get('resume', 'ResumeController@index')->name('resume');

Route::get('portfolio', 'PortfolioController@index')->name('portfolio');

Route::get('contacts', 'ContactController@index')->name('contacts');

Route::post('contact_me', 'ContactController@contactMe')->name('contact_me');

Route::resource('articles', 'ArticleController', [
    'parameters' => [
        'articles' => 'article'
    ]
])->only(['index', 'show']);

Route::get('articles/cat/{cat_slug?}', 'ArticleController@index')->where('cat_slug', '[\w-]+')->name('articles_cat');

Route::resource('comment', 'CommentController')->only(['store']);

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/', 'IndexController@index')->name('dashboard');

    Route::get('/chart_data', 'IndexController@getChartData')->name('chart_data');

    Route::get('/sparkline_data', 'IndexController@getSparklineData')->name('sparkline_data');

    Route::resource('/page/blog', 'ArticleController', [
        'parameters' => [
            'blog' => 'article'
            ]
        ])->except(['show']);

    Route::resource('/article/category', 'ArticleCategoryController')->except(['show']);

    Route::resource('/page/portfolio', 'PortfolioController')->except(['show']);

    Route::resource('/page/contact', 'ContactController')->except(['show']);

    Route::resource('/page/profile', 'ProfileController')->except(['show']);

    Route::resource('/pages', 'PageController')->except(['show']);

    Route::resource('/info/personal', 'PersonalInfoController')->except(['show']);

    Route::resource('/experiences', 'ExperienceController')->except(['show']);

    Route::resource('/education', 'EducationController')->except(['show']);

    Route::resource('/skills/languages', 'LanguageSkillController')->except(['show']);

    Route::resource('/skills/categories', 'SkillCategoryController')->except(['show']);

    Route::resource('/skills', 'SkillController')->except(['show']);

    Route::resource('/users', 'UserController')->except(['show']);

    Route::resource('/messages', 'MessageController')->only(['index', 'show', 'destroy']);

    Route::resource('/settings', 'SettingController')->except(['show']);

    Route::resource('/privileges', 'PrivilegeController')->only(['index', 'store', 'destroy']);

    Route::get('/search/messages', 'MessageController@search')->name('search_messages');

    Route::resource('/comments', 'CommentController')->only('destroy');

    Route::resource('/roles', 'RoleController')->except(['show']);

    Route::resource('/visitors', 'VisitorController')->only('index');

    Route::get('/visitors_data', 'VisitorController@visitorsList')->name('visitor_data');

    Route::get('/visited_pages/{visitor}', 'VisitorController@visitedPages')->name('visited_pages');
});
