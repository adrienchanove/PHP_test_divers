<?php

/**
 * Fichier de definition des routes
 * 
 */

 // Controller index (page commune)
Route::add('/', 'index', 'index');
Route::add('contact', 'index', 'contact');
Route::add('about', 'index', 'about');

// Controller user (gestion des utilisateurs)
Route::add('login', 'user', 'login');
Route::add('logout', 'user', 'logout');
Route::add('register', 'user', 'register');
Route::add('profile', 'user', 'profile');
Route::add('profile/edit', 'user', 'edit');
Route::add('profile/delete', 'user', 'delete');
Route::add('admin', 'user', 'admin');
Route::add('admin/users', 'user', 'admin_users');