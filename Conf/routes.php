<?php

/**
 * Fichier de definition des routes
 * 
 */

 // Controller index (page commune)
Route::add('/', 'index', 'index');
Route::add('contact', 'index', 'contact');
Route::add('about', 'index', 'about');
Route::add('faq', 'user', 'faq',['auth' => true]);

// Controller user (gestion des utilisateurs)
Route::add('login', 'user', 'login');
Route::add('logout', 'user', 'logout');
Route::add('register', 'user', 'register');
Route::add('profile', 'user', 'profile',['auth' => true]);
Route::add('profile/edit', 'user', 'edit',['auth' => true]);
Route::add('profile/delete', 'user', 'delete',['auth' => true]);
Route::add('admin', 'user', 'admin',['auth' => true]);
Route::add('admin/bdd', 'user', 'admin_bdd',['auth' => true]);
// Messages
Route::add('message', 'user', 'message',['auth' => true]);