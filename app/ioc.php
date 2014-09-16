<?php

/*
|--------------------------------------------------------------------------
| Application Inversion of Control
|--------------------------------------------------------------------------
|
| Class Bindings
|
*/

App::bind('UserRepositoryInterface', 'UserRepository');
App::bind('RoleRepositoryInterface', 'RoleRepository');
App::bind('ProductRepositoryInterface', 'ProductRepository');
