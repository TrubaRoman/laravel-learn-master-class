<?php
    use App\Models\User;
    use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

// Home
    Breadcrumbs::for('home', function ($trail) {
        $trail->push('Home', route('home'));
    });

// Home > Login
    Breadcrumbs::for('login', function ($trail) {
        $trail->parent('home');
        $trail->push('Login', route('login'));
    });

// Home > Register
    Breadcrumbs::for('register', function ($trail) {
        $trail->parent('home');
        $trail->push('Register', route('register'));
    });

// Home > Login > Reset Password
    Breadcrumbs::for('password.request', function ($trail) {
        $trail->parent('login');
        $trail->push('Reset Password', route('password.request'));
    });


// Home > Login > Reset password > Change
    Breadcrumbs::for('password.reset', function ($trail) {
        $trail->parent('password.request');
        $trail->push('Change', route('password.reset'));
    })

;// Home > Cabinet
    Breadcrumbs::for('cabinet', function ($trail) {
        $trail->parent('home');
        $trail->push('Cabinet', route('cabinet'));
    });

 //////////////////////__ADMIN_////////


    Breadcrumbs::for('admin.home',function($trail){
        $trail->parent('home');
        $trail->push('Admin',route('admin.home'));
    });

    Breadcrumbs::for('admin.users.index',function ($trail){
       $trail->parent('admin.home');
       $trail->push('Users', route('admin.users.index'));
    });

    Breadcrumbs::for('admin.users.create',function ($trail){
        $trail->parent('admin.users.index');
        $trail->push('Create',route('admin.users.create'));
    });

    Breadcrumbs::for('admin.users.show',function ($trail,User $user){
        $trail->parent('admin.users.index');
        $trail->push($user->name, route('admin.users.show',$user));
    });

    Breadcrumbs::for('admin.users.edit',function ($trail,User $user){
        $trail->parent('admin.users.show',$user);
        $trail->push('Edit',route('admin.users.edit',$user));
    });

