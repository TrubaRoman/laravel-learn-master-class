<?php
    use App\Models\User;
    use App\Models\Region;
    use App\Models\Adverts\Category;
    use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
    use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

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
//////////////////////////_ADMIN.USERS_////////////////////////////
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


    //////////////////////////_ADMIN.REGIONS_////////////////////////////
    Breadcrumbs::for('admin.regions.index',function ($trail){
       $trail->parent('admin.home');
       $trail->push('Regions', route('admin.regions.index'));
    });

    Breadcrumbs::for('admin.regions.create',function ($trail){
        $trail->parent('admin.regions.index');
        $trail->push('Create',route('admin.regions.create'));
    });

    Breadcrumbs::for('admin.regions.show',function ($trail,Region $region){
        if ($parent = $region->parent)
        {
            $trail->parent('admin.regions.show',$parent);
        } else {
            $trail->parent('admin.regions.index');
        }
        $trail->push($region->name, route('admin.regions.show',$region));
    });

    Breadcrumbs::for('admin.regions.edit',function ($trail,Region $region){
        $trail->parent('admin.regions.show',$region);
        $trail->push('Edit',route('admin.regions.edit',$region));
    });
  ///////////////////////////////_ADMIN_ADVERTS_CATEGORIES_////////////////////////////////////

    Breadcrumbs::for('admin.adverts.categories.index',function ($trail){
        $trail->parent('admin.home');
        $trail->push('Categories', route('admin.adverts.categories.index'));
    });

    Breadcrumbs::for('admin.adverts.categories.create',function ($trail){
        $trail->parent('admin.adverts.categories.index');
        $trail->push('Create',route('admin.adverts.categories.create'));
    });

    Breadcrumbs::for('admin.adverts.categories.show',function ($trail,Category $category){
        if ($parent = $category->parent)
        {
            $trail->parent('admin.adverts.categories.show',$parent);
        } else {
            $trail->parent('admin.adverts.categories.index');
        }
        $trail->push($category->name, route('admin.adverts.categories.show',$category));
    });

    Breadcrumbs::for('admin.adverts.categories.edit',function ($trail,Category $category){
        $trail->parent('admin.adverts.categories.show',$category);
        $trail->push('Edit',route('admin.adverts.categories.edit',$category));
    });
