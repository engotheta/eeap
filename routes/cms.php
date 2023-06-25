<?php

/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
| All route for the content management system
|
*/

use Illuminate\Support\Facades\Route;

Route::get('system', 'cms\UserController@login');

//2022-02-01 use this for login to have login throttling... of 3 attempts for 30 minutes
Route::post('auth/login', 'Auth\LoginController@login');
//Route::post('auth/login', 'cms\UserController@authenticate');
Route::get('auth/logout', 'cms\UserController@logout')->middleware('auth');

Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('menu/menu-items/{id}/edit', 'cms\MenuItemsController@edit');

Route::middleware(['auth','checked','cors'])->prefix('cms')->name('cms.')->group(function(){

    Route::get('/',['as'=>'cms.dashboard.view-dashboard','uses'=>'cms\DashboardController@index']);

    Route::resource('backgrounds', 'cms\BackgroundsController');

    Route::resource('online_services', 'cms\OnlineServicesController');
    
    Route::resource('services', 'cms\ServicesController');

    Route::resource('trainings', 'cms\TrainingsController');

    Route::resource('operators', 'cms\OperatorsController');

    Route::resource('colateral-managers', 'cms\ColateralManagersController');
    
    Route::resource('colateral_managers', 'cms\ColateralManagersController');

    Route::resource('warehouses', 'cms\WarehousesController');

    Route::resource('licensed-entities', 'cms\LicensedEntitiesController');

    Route::resource('stakeholders', 'cms\StakeholdersController');

    Route::get('stakeholders/add/{slug}', 'cms\StakeholdersController@add');

    Route::post('licensed-entities-upload', 'cms\LicensedEntitiesController@uploadLicensedEntity')->name('licensed.entities.upload');

    // Route::resource('licensed-entity-categories', 'cms\LicensedEntitiesCategoriesController');

    // Route::resource('stakeholders', 'cms\StakeholdersController');

    Route::resource('stakeholder-categories', 'cms\StakeholdersCategoriesController');

    // Route::resource('achievements', 'cms\AchievementsController');

    Route::resource('howdois', 'cms\HowDoIsController');

    Route::resource('seo', 'cms\SeoController');

    Route::resource('preferences', 'cms\PreferencesController');

    Route::resource('faqs', 'cms\FaqsController');

    Route::resource('news', 'cms\NewsController');

    Route::resource('more-infos', 'cms\MoreInfosController');

    Route::resource('campaigns', 'cms\CampaignsController');

    Route::resource('events', 'cms\EventsController');

    Route::resource('agriculture-maps', 'cms\AgricultureMapsController');
    
    Route::resource('regional_office', 'cms\RegionalOfficesController');

    Route::resource('feedbacks', 'cms\ComplaintsController');

    Route::resource('quick_links', 'cms\QuickLinksController');

    Route::resource('related_links', 'cms\RelatedLinksController');

    Route::resource('media_links', 'cms\MediaLinksController');

    Route::resource('important_links', 'cms\ImportantLinksController');

    Route::resource('social_links', 'cms\SocialLinksController');

    Route::resource('about_links', 'cms\AboutLinksController');
    
    Route::resource('support_links', 'cms\SupportLinksController');
    
    // Route::resource('ict_links', 'cms\IctLinksController');

    Route::resource('home_links', 'cms\HomeLinksController');
    
    Route::resource('googlemaps', 'cms\GoogleMapsController');
    
    Route::resource('welcome', 'cms\WelcomeNoteController');

    Route::resource('dg_messages', 'cms\DgMessagesController');

    Route::resource('announcements', 'cms\AnnouncementsController');
    
    // Route::resource('hospitals', 'cms\HospitalsController');
    
    // Route::resource('quotes', 'cms\QuotesController');

    Route::resource('partners', 'cms\PartnersController');

    Route::resource('press_releases', 'cms\PressReleasesController');
    
    Route::resource('speeches', 'cms\SpeechesController');
    
    Route::resource('administration', 'cms\AdministrationController');

    Route::resource('administration_categories', 'cms\AdministrationCategoriesController');
    
    Route::resource('administration_categories_members', 'cms\AdministrationCategoriesMembersController', ['except' => ['index', 'create', 'show', 'edit']]);

    Route::resource('document-categories', 'cms\DocumentsCategoriesController');

    Route::resource('documents', 'cms\DocumentsController');

    Route::resource('quickinfos', 'cms\QuickInfosController');

    Route::resource('product_categories', 'cms\ProductCategoriesController');

    Route::resource('products', 'cms\ProductsController');

    Route::resource('translations', 'cms\TranslationsController',['except'=>['edit','update']]);

    Route::post('trans_update', array(
        "uses" => "cms\TranslationsController@trans_update",
        "as"   => "translations.update",
    ));

    Route::resource('menu', 'cms\MenusController');

    Route::get('menu/menu-items/{id}/edit', 'cms\MenuItemsController@edit');

    Route::resource('menu-items', 'cms\MenuItemsController', ['except' => ['index','edit']]);

    Route::get('menu-items/list/{menuID}',['as'=>'menu-items.index','uses'=>'cms\MenuItemsController@index']);

    Route::any('ajax_menu_update', array(
        'uses' => 'cms\MenuItemsController@ajax_update',
        'as'   => 'menu-items.ajax-update',
    ));

    Route::any('ajax_menu_update/{slug}', array(
        'uses' => 'cms\MenuItemsController@ajax_link_update',
        'as'   => 'menu-items.ajax-link-update',
    ));
    
    Route::resource('galleries', 'cms\GalleriesController');

    Route::resource('media', 'cms\MediaController', ['except' => ['index']]);

    Route::patch('media/transfer-media/{id}', ['as'=>'media.transfer-media','uses'=>'cms\MediaController@transferMedia']);

    Route::patch('media/transfer-gallery/{id}', ['as'=>'media.transfer-gallery','uses'=>'cms\MediaController@transferGallery']);

    Route::get('media/list/{galleryID}',['as'=>'media.index','uses'=>'cms\MediaController@index']);

    Route::get('media/list/{galleryID}/create',['as'=>'media.create','uses'=>'cms\MediaController@create']);

    Route::get('media/bulk/{galleryID}/create',['as'=>'media.bulk','uses'=>'cms\MediaController@bulk']);

    Route::post('media/bulk-upload-images/{id}', ['as'=>'media.bulk-upload-images','uses'=>'cms\MediaController@bulkUpload']);

    Route::resource('pages', 'cms\PagesController');

    //Route::resource('special-pages', 'cms\SpecialPagesController');

    // Route::resource('page-categories', 'cms\PageCategoriesController');

    Route::resource('roles', 'cms\RolesController',['except'=>['create']]);

    Route::any('upload', array(
        'uses' => 'cms\UploadsController@upload',
        'as'   => 'cms.text-editor.upload',
    ));

    Route::any('upload_file', array(
        'uses' => 'cms\UploadsController@upload_file',
        'as'   => 'cms.text-editor.upload_file',
    ));

    Route::any('getimages', array(
        'uses' => 'cms\UploadsController@getImages',
        'as'   => 'cms.text-editor.getimages',
    ));

    Route::any('getfiles', array(
        'uses' => 'cms\UploadsController@getFiles',
        'as'   => 'cms.text-editor.getfiles',
    ));

    Route::any('delete_file', array(
        'uses' => 'cms\UploadsController@deleteFile',
        'as'   => 'cms.text-editor.delete_file',
    ));

    Route::get('user-registration-form', array(
        'uses' => 'cms\UserController@registerForm',
        'as'   => 'users.create-user-form',
    ));

   Route::get('user-registration-form/{id}', array(
        'uses' => 'cms\UserController@userForm',
        'as'   => 'users.edit-user',
        ));

    Route::post('update-user/{id}', array(
        'uses' => 'cms\UserController@updateUserForm',
        'as'   => 'users.update-user',
        ));

    Route::delete('users/{id}', array(
        'uses' => 'cms\UserController@destroy',
        'as'   => 'users.destroy'
    ));

    Route::post('user-register', array(
        'uses' => 'cms\UserController@createUser',
        'as'   => 'users.create-user',
    ));

    Route::get('user-roles/{userID}', array(
        'uses' => 'cms\UserController@userRolesForm',
        'as'   => 'users.user-roles-form',
    ));

    Route::post('user-roles-update', array(
        'uses' => 'cms\UserController@updateUserRoles',
        'as'   => 'users.update-user-roles',
    ));

    Route::get('user-permissions/{userID}', array(
        'uses' => 'cms\UserController@userPermissionsForm',
        'as'   => 'users.user-permissions-form',
    ));

    Route::post('user-permissions-update', array(
        'uses' => 'cms\UserController@updateUserPermissions',
        'as'   => 'users.update-user-permissions',
    ));

    Route::get('user-change-password', array(
        'uses' => 'cms\UserController@changeUserPasswordForm',
        'as'   => 'users.user-change-password-form',
    ));

    Route::post('user-change-password', array(
        'uses' => 'cms\UserController@updateUserPassword',
        'as'   => 'users.user-change-password',
    ));

});

Route::get('language/{lang}', 'cms\LanguageController@change');
