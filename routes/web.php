<?php
//Route::get('/', "PageController@index");

// Authentication Routes...
//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name("login");
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset/', 'Auth\ResetPasswordController@reset');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('/', 'GuestController@index')->name('home');



Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/1crearjson', "aController@crearJsonIni");
    Route::get('/2generar', "aController@crearDesdeElJson");

    Route::get('/rollback', "aController@rollback");

});
Route::group(['middleware' => ['role:user|admin', 'auth']], function () {
    Route::get('/home', 'UserController@index')->name('home');



});
Route::get('/pruebadepost', "aController@pruebademodelo");


/*<SG-autoRoute>*/


Route::group(['prefix' => 'categorias'], function () {
    Route::get('index', 'admin1\categoriasController@index')->name('admin1.categorias.index');
    Route::get('create', 'admin1\categoriasController@create')->name('admin1.categorias.create');
    Route::get('edit/{id}', 'admin1\categoriasController@edit')->name('admin1.categorias.edit');
    Route::get('detail/{id}', 'admin1\categoriasController@show')->name('admin1.categorias.detail');
    Route::post('store', 'admin1\categoriasController@store')->name('admin1.categorias.store');
    Route::post('update/{id}', 'admin1\categoriasController@update')->name('admin1.categorias.update');
    Route::delete('delete/{id}', 'admin1\categoriasController@delete')->name('admin1.categorias.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\categoriasController@store')->name('api.categorias.store');
        Route::post('update/{id}', 'Api\admin1\categoriasController@update')->name('api.categorias.update');
        Route::post('delete/{id}', 'Api\admin1\categoriasController@delete')->name('api.categorias.delete');   
        Route::get('detail/{id}', 'Api\admin1\categoriasController@show')->name('api.categorias.detail');   
        Route::get('all', 'Api\admin1\categoriasController@all')->name('api.categorias.all');
    });  
});



Route::group(['prefix' => 'ingredientereceta'], function () {
    Route::get('index', 'admin1\ingredienteRecetaController@index')->name('admin1.ingredientereceta.index');
    Route::get('create', 'admin1\ingredienteRecetaController@create')->name('admin1.ingredientereceta.create');
    Route::get('edit/{id}', 'admin1\ingredienteRecetaController@edit')->name('admin1.ingredientereceta.edit');
    Route::get('detail/{id}', 'admin1\ingredienteRecetaController@show')->name('admin1.ingredientereceta.detail');
    Route::post('store', 'admin1\ingredienteRecetaController@store')->name('admin1.ingredientereceta.store');
    Route::post('update/{id}', 'admin1\ingredienteRecetaController@update')->name('admin1.ingredientereceta.update');
    Route::delete('delete/{id}', 'admin1\ingredienteRecetaController@delete')->name('admin1.ingredientereceta.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\ingredienteRecetaController@store')->name('api.ingredientereceta.store');
        Route::post('update/{id}', 'Api\admin1\ingredienteRecetaController@update')->name('api.ingredientereceta.update');
        Route::post('delete/{id}', 'Api\admin1\ingredienteRecetaController@delete')->name('api.ingredientereceta.delete');   
        Route::get('detail/{id}', 'Api\admin1\ingredienteRecetaController@show')->name('api.ingredientereceta.detail');   
        Route::get('all', 'Api\admin1\ingredienteRecetaController@all')->name('api.ingredientereceta.all');
    });  
});



Route::group(['prefix' => 'ingredientes'], function () {
    Route::get('index', 'admin1\ingredientesController@index')->name('admin1.ingredientes.index');
    Route::get('create', 'admin1\ingredientesController@create')->name('admin1.ingredientes.create');
    Route::get('edit/{id}', 'admin1\ingredientesController@edit')->name('admin1.ingredientes.edit');
    Route::get('detail/{id}', 'admin1\ingredientesController@show')->name('admin1.ingredientes.detail');
    Route::post('store', 'admin1\ingredientesController@store')->name('admin1.ingredientes.store');
    Route::post('update/{id}', 'admin1\ingredientesController@update')->name('admin1.ingredientes.update');
    Route::delete('delete/{id}', 'admin1\ingredientesController@delete')->name('admin1.ingredientes.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\ingredientesController@store')->name('api.ingredientes.store');
        Route::post('update/{id}', 'Api\admin1\ingredientesController@update')->name('api.ingredientes.update');
        Route::post('delete/{id}', 'Api\admin1\ingredientesController@delete')->name('api.ingredientes.delete');   
        Route::get('detail/{id}', 'Api\admin1\ingredientesController@show')->name('api.ingredientes.detail');   
        Route::get('all', 'Api\admin1\ingredientesController@all')->name('api.ingredientes.all');
    });  
});



Route::group(['prefix' => 'migrations'], function () {
    Route::get('index', 'admin1\migrationsController@index')->name('admin1.migrations.index');
    Route::get('create', 'admin1\migrationsController@create')->name('admin1.migrations.create');
    Route::get('edit/{id}', 'admin1\migrationsController@edit')->name('admin1.migrations.edit');
    Route::get('detail/{id}', 'admin1\migrationsController@show')->name('admin1.migrations.detail');
    Route::post('store', 'admin1\migrationsController@store')->name('admin1.migrations.store');
    Route::post('update/{id}', 'admin1\migrationsController@update')->name('admin1.migrations.update');
    Route::delete('delete/{id}', 'admin1\migrationsController@delete')->name('admin1.migrations.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\migrationsController@store')->name('api.migrations.store');
        Route::post('update/{id}', 'Api\admin1\migrationsController@update')->name('api.migrations.update');
        Route::post('delete/{id}', 'Api\admin1\migrationsController@delete')->name('api.migrations.delete');   
        Route::get('detail/{id}', 'Api\admin1\migrationsController@show')->name('api.migrations.detail');   
        Route::get('all', 'Api\admin1\migrationsController@all')->name('api.migrations.all');
    });  
});



Route::group(['prefix' => 'passwordresets'], function () {
    Route::get('index', 'admin1\passwordResetsController@index')->name('admin1.passwordresets.index');
    Route::get('create', 'admin1\passwordResetsController@create')->name('admin1.passwordresets.create');
    Route::get('edit/{id}', 'admin1\passwordResetsController@edit')->name('admin1.passwordresets.edit');
    Route::get('detail/{id}', 'admin1\passwordResetsController@show')->name('admin1.passwordresets.detail');
    Route::post('store', 'admin1\passwordResetsController@store')->name('admin1.passwordresets.store');
    Route::post('update/{id}', 'admin1\passwordResetsController@update')->name('admin1.passwordresets.update');
    Route::delete('delete/{id}', 'admin1\passwordResetsController@delete')->name('admin1.passwordresets.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\passwordResetsController@store')->name('api.passwordresets.store');
        Route::post('update/{id}', 'Api\admin1\passwordResetsController@update')->name('api.passwordresets.update');
        Route::post('delete/{id}', 'Api\admin1\passwordResetsController@delete')->name('api.passwordresets.delete');   
        Route::get('detail/{id}', 'Api\admin1\passwordResetsController@show')->name('api.passwordresets.detail');   
        Route::get('all', 'Api\admin1\passwordResetsController@all')->name('api.passwordresets.all');
    });  
});



Route::group(['prefix' => 'permissionrole'], function () {
    Route::get('index', 'admin1\permissionRoleController@index')->name('admin1.permissionrole.index');
    Route::get('create', 'admin1\permissionRoleController@create')->name('admin1.permissionrole.create');
    Route::get('edit/{id}', 'admin1\permissionRoleController@edit')->name('admin1.permissionrole.edit');
    Route::get('detail/{id}', 'admin1\permissionRoleController@show')->name('admin1.permissionrole.detail');
    Route::post('store', 'admin1\permissionRoleController@store')->name('admin1.permissionrole.store');
    Route::post('update/{id}', 'admin1\permissionRoleController@update')->name('admin1.permissionrole.update');
    Route::delete('delete/{id}', 'admin1\permissionRoleController@delete')->name('admin1.permissionrole.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\permissionRoleController@store')->name('api.permissionrole.store');
        Route::post('update/{id}', 'Api\admin1\permissionRoleController@update')->name('api.permissionrole.update');
        Route::post('delete/{id}', 'Api\admin1\permissionRoleController@delete')->name('api.permissionrole.delete');   
        Route::get('detail/{id}', 'Api\admin1\permissionRoleController@show')->name('api.permissionrole.detail');   
        Route::get('all', 'Api\admin1\permissionRoleController@all')->name('api.permissionrole.all');
    });  
});



Route::group(['prefix' => 'permissions'], function () {
    Route::get('index', 'admin1\permissionsController@index')->name('admin1.permissions.index');
    Route::get('create', 'admin1\permissionsController@create')->name('admin1.permissions.create');
    Route::get('edit/{id}', 'admin1\permissionsController@edit')->name('admin1.permissions.edit');
    Route::get('detail/{id}', 'admin1\permissionsController@show')->name('admin1.permissions.detail');
    Route::post('store', 'admin1\permissionsController@store')->name('admin1.permissions.store');
    Route::post('update/{id}', 'admin1\permissionsController@update')->name('admin1.permissions.update');
    Route::delete('delete/{id}', 'admin1\permissionsController@delete')->name('admin1.permissions.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\permissionsController@store')->name('api.permissions.store');
        Route::post('update/{id}', 'Api\admin1\permissionsController@update')->name('api.permissions.update');
        Route::post('delete/{id}', 'Api\admin1\permissionsController@delete')->name('api.permissions.delete');   
        Route::get('detail/{id}', 'Api\admin1\permissionsController@show')->name('api.permissions.detail');   
        Route::get('all', 'Api\admin1\permissionsController@all')->name('api.permissions.all');
    });  
});



Route::group(['prefix' => 'procedimientos'], function () {
    Route::get('index', 'admin1\procedimientosController@index')->name('admin1.procedimientos.index');
    Route::get('create', 'admin1\procedimientosController@create')->name('admin1.procedimientos.create');
    Route::get('edit/{id}', 'admin1\procedimientosController@edit')->name('admin1.procedimientos.edit');
    Route::get('detail/{id}', 'admin1\procedimientosController@show')->name('admin1.procedimientos.detail');
    Route::post('store', 'admin1\procedimientosController@store')->name('admin1.procedimientos.store');
    Route::post('update/{id}', 'admin1\procedimientosController@update')->name('admin1.procedimientos.update');
    Route::delete('delete/{id}', 'admin1\procedimientosController@delete')->name('admin1.procedimientos.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\procedimientosController@store')->name('api.procedimientos.store');
        Route::post('update/{id}', 'Api\admin1\procedimientosController@update')->name('api.procedimientos.update');
        Route::post('delete/{id}', 'Api\admin1\procedimientosController@delete')->name('api.procedimientos.delete');   
        Route::get('detail/{id}', 'Api\admin1\procedimientosController@show')->name('api.procedimientos.detail');   
        Route::get('all', 'Api\admin1\procedimientosController@all')->name('api.procedimientos.all');
    });  
});



Route::group(['prefix' => 'recetas'], function () {
    Route::get('index', 'admin1\recetasController@index')->name('admin1.recetas.index');
    Route::get('create', 'admin1\recetasController@create')->name('admin1.recetas.create');
    Route::get('edit/{id}', 'admin1\recetasController@edit')->name('admin1.recetas.edit');
    Route::get('detail/{id}', 'admin1\recetasController@show')->name('admin1.recetas.detail');
    Route::post('store', 'admin1\recetasController@store')->name('admin1.recetas.store');
    Route::post('update/{id}', 'admin1\recetasController@update')->name('admin1.recetas.update');
    Route::delete('delete/{id}', 'admin1\recetasController@delete')->name('admin1.recetas.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\recetasController@store')->name('api.recetas.store');
        Route::post('update/{id}', 'Api\admin1\recetasController@update')->name('api.recetas.update');
        Route::post('delete/{id}', 'Api\admin1\recetasController@delete')->name('api.recetas.delete');   
        Route::get('detail/{id}', 'Api\admin1\recetasController@show')->name('api.recetas.detail');   
        Route::get('all', 'Api\admin1\recetasController@all')->name('api.recetas.all');
    });  
});



Route::group(['prefix' => 'roleuser'], function () {
    Route::get('index', 'admin1\roleUserController@index')->name('admin1.roleuser.index');
    Route::get('create', 'admin1\roleUserController@create')->name('admin1.roleuser.create');
    Route::get('edit/{id}', 'admin1\roleUserController@edit')->name('admin1.roleuser.edit');
    Route::get('detail/{id}', 'admin1\roleUserController@show')->name('admin1.roleuser.detail');
    Route::post('store', 'admin1\roleUserController@store')->name('admin1.roleuser.store');
    Route::post('update/{id}', 'admin1\roleUserController@update')->name('admin1.roleuser.update');
    Route::delete('delete/{id}', 'admin1\roleUserController@delete')->name('admin1.roleuser.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\roleUserController@store')->name('api.roleuser.store');
        Route::post('update/{id}', 'Api\admin1\roleUserController@update')->name('api.roleuser.update');
        Route::post('delete/{id}', 'Api\admin1\roleUserController@delete')->name('api.roleuser.delete');   
        Route::get('detail/{id}', 'Api\admin1\roleUserController@show')->name('api.roleuser.detail');   
        Route::get('all', 'Api\admin1\roleUserController@all')->name('api.roleuser.all');
    });  
});



Route::group(['prefix' => 'roles'], function () {
    Route::get('index', 'admin1\rolesController@index')->name('admin1.roles.index');
    Route::get('create', 'admin1\rolesController@create')->name('admin1.roles.create');
    Route::get('edit/{id}', 'admin1\rolesController@edit')->name('admin1.roles.edit');
    Route::get('detail/{id}', 'admin1\rolesController@show')->name('admin1.roles.detail');
    Route::post('store', 'admin1\rolesController@store')->name('admin1.roles.store');
    Route::post('update/{id}', 'admin1\rolesController@update')->name('admin1.roles.update');
    Route::delete('delete/{id}', 'admin1\rolesController@delete')->name('admin1.roles.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\rolesController@store')->name('api.roles.store');
        Route::post('update/{id}', 'Api\admin1\rolesController@update')->name('api.roles.update');
        Route::post('delete/{id}', 'Api\admin1\rolesController@delete')->name('api.roles.delete');   
        Route::get('detail/{id}', 'Api\admin1\rolesController@show')->name('api.roles.detail');   
        Route::get('all', 'Api\admin1\rolesController@all')->name('api.roles.all');
    });  
});



Route::group(['prefix' => 'users'], function () {
    Route::get('index', 'admin1\usersController@index')->name('admin1.users.index');
    Route::get('create', 'admin1\usersController@create')->name('admin1.users.create');
    Route::get('edit/{id}', 'admin1\usersController@edit')->name('admin1.users.edit');
    Route::get('detail/{id}', 'admin1\usersController@show')->name('admin1.users.detail');
    Route::post('store', 'admin1\usersController@store')->name('admin1.users.store');
    Route::post('update/{id}', 'admin1\usersController@update')->name('admin1.users.update');
    Route::delete('delete/{id}', 'admin1\usersController@delete')->name('admin1.users.delete');   
    Route::group(['prefix' => 'api'], function () {
        Route::post('store', 'Api\admin1\usersController@store')->name('api.users.store');
        Route::post('update/{id}', 'Api\admin1\usersController@update')->name('api.users.update');
        Route::post('delete/{id}', 'Api\admin1\usersController@delete')->name('api.users.delete');   
        Route::get('detail/{id}', 'Api\admin1\usersController@show')->name('api.users.detail');   
        Route::get('all', 'Api\admin1\usersController@all')->name('api.users.all');
    });  
});


/*<SG-autoRoute>*/