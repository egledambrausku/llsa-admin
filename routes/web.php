<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('coaches', 'Admin\CoachesController');
    Route::post('coaches_mass_destroy', ['uses' => 'Admin\CoachesController@massDestroy', 'as' => 'coaches.mass_destroy']);
    Route::post('coaches_restore/{id}', ['uses' => 'Admin\CoachesController@restore', 'as' => 'coaches.restore']);
    Route::delete('coaches_perma_del/{id}', ['uses' => 'Admin\CoachesController@perma_del', 'as' => 'coaches.perma_del']);
    Route::resource('clubs', 'Admin\ClubsController');
    Route::post('clubs_mass_destroy', ['uses' => 'Admin\ClubsController@massDestroy', 'as' => 'clubs.mass_destroy']);
    Route::post('clubs_restore/{id}', ['uses' => 'Admin\ClubsController@restore', 'as' => 'clubs.restore']);
    Route::delete('clubs_perma_del/{id}', ['uses' => 'Admin\ClubsController@perma_del', 'as' => 'clubs.perma_del']);
    Route::resource('kids', 'Admin\KidsController');
    //
    Route::get('allkids', 'Admin\KidsController@allKids');
    Route::get('competitions/{comp}/register', 'Admin\CompetitionsController@getRegister');
    Route::post('competitions/register', 'Admin\CompetitionsController@postRegister');
    Route::get('competitions/{comp}/allkids', 'Admin\CompetitionsController@allRegisteredKids');
//    Route::get('competitions/{comp}/editregistration', 'Admin\CompetitionsController@editRegistration');
    Route::delete('competitions/{comp}/destroyregistration/{kidId}', ['uses' => 'Admin\CompetitionsController@destroyRegistration', 'as' => 'registration.destroy']);

    Route::post('kids_mass_destroy', ['uses' => 'Admin\KidsController@massDestroy', 'as' => 'kids.mass_destroy']);
    Route::post('kids_restore/{id}', ['uses' => 'Admin\KidsController@restore', 'as' => 'kids.restore']);
    Route::delete('kids_perma_del/{id}', ['uses' => 'Admin\KidsController@perma_del', 'as' => 'kids.perma_del']);
    Route::resource('competitions', 'Admin\CompetitionsController');
    Route::post('competitions_mass_destroy', ['uses' => 'Admin\CompetitionsController@massDestroy', 'as' => 'competitions.mass_destroy']);
    Route::post('competitions_restore/{id}', ['uses' => 'Admin\CompetitionsController@restore', 'as' => 'competitions.restore']);
    Route::delete('competitions_perma_del/{id}', ['uses' => 'Admin\CompetitionsController@perma_del', 'as' => 'competitions.perma_del']);
    Route::resource('groups', 'Admin\GroupsController');
    Route::post('groups_mass_destroy', ['uses' => 'Admin\GroupsController@massDestroy', 'as' => 'groups.mass_destroy']);
    Route::post('groups_restore/{id}', ['uses' => 'Admin\GroupsController@restore', 'as' => 'groups.restore']);
    Route::delete('groups_perma_del/{id}', ['uses' => 'Admin\GroupsController@perma_del', 'as' => 'groups.perma_del']);



 
});
