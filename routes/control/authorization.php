<?php

Route::name('control.authorization.role.read')->get('/role', 'Control\Authorization\RoleController@read');
Route::name('control.authorization.role.read.search')->get('/role/?search={value}', 'Control\Authorization\RoleController@read');
Route::name('control.authorization.role.create')->get('/role/create', 'Control\Authorization\RoleController@create');
Route::name('control.authorization.role.create.post')->post('/role/create', 'Control\Authorization\RoleController@createPost');
Route::name('control.authorization.role.update')->get('/role/{id}/update', 'Control\Authorization\RoleController@update')->where('id', '[0-9]+');
Route::name('control.authorization.role.update')->get('/role/{id}/update', 'Control\Authorization\RoleController@update')->where('id', '[0-9]+');
Route::name('control.authorization.role.update.post')->post('/role/post', 'Control\Authorization\RoleController@updatePost');
Route::name('control.authorization.role.delete')->get('/role/{id}/delete', 'Control\Authorization\RoleController@delete')->where('id', '[0-9]+');

Route::name('control.authorization.permission.read')->get('/permission', 'Control\Authorization\PermissionController@read');
Route::name('control.authorization.permission.read.search')->get('/permission/?search={value}', 'Control\Authorization\PermissionController@read');
Route::name('control.authorization.permission.read.page')->get('/permission/?search=&page={value}', 'Control\Authorization\PermissionController@read');
Route::name('control.authorization.permission.create')->get('/permission/create', 'Control\Authorization\PermissionController@create');
Route::name('control.authorization.permission.create.post')->post('/permission/create', 'Control\Authorization\PermissionController@createPost');
Route::name('control.authorization.permission.update')->get('/permission/{id}/update', 'Control\Authorization\PermissionController@update')->where('id', '[0-9]+');
Route::name('control.authorization.permission.update.post')->post('/permission/post', 'Control\Authorization\PermissionController@updatePost');
Route::name('control.authorization.permission.delete')->get('/permission/{id}/delete', 'Control\Authorization\PermissionController@delete')->where('id', '[0-9]+');

Route::name('control.authorization.role.read.permission')->get('/role/{id}/permission', 'Control\Authorization\AuthorizationPermissionRoleController@readPermission')->where('id', '[0-9]+');
Route::name('control.authorization.permission.revoke')->get('/role/{role_id}/permission/{permission_id}/revoke', 'Control\Authorization\AuthorizationPermissionRoleController@revoke')->where('role_id', '[0-9]+')->where('permission_id', '[0-9]+');
Route::name('control.authorization.permission.remove')->get('/user/{id}/permission/remove', 'Control\Authorization\AuthorizationPermissionRoleController@remove')->where('id', '[0-9]+');
Route::name('control.authorization.permission.authorize.post')->post('/role/{id}/permission/authorize', 'Control\Authorization\AuthorizationPermissionRoleController@authorizePermission')->where('id', '[0-9]+');
