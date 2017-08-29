<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Define your dashboard here.';
    return AdminSection::view($content, 'Dashboard');
}]);

Route::get('information', ['as' => 'admin.information', function () {
	$content = 'Define your information here.';
	return AdminSection::view($content, 'Information');
}]);

/*Route::get('users', ['as' => 'admin.users', function () {
    $content = 'Look and change all users';
    return AdminSection::view($content, 'Users');
}]);*/

Route::get('add_user', ['as' => 'admin.add users', function () {
    $content = 'Add user here.';
    return AdminSection::view($content, 'Add user');
}]);