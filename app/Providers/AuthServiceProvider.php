<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user){
            if ($user->isManager) {
                return true;
            }
        });

        Gate::define('view-users', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$VIEW_USERS);
        });

        Gate::define('add-user', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$ADD_USERS);
        });

        Gate::define('edit-user', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$EDIT_USERS);
        });

        Gate::define('delete-user', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$DELETE_USERS);
        });

        Gate::define('view-customers', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$VIEW_CUSTOMERS);
        });

        Gate::define('add-customer', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$ADD_CUSTOMERS);
        });

        Gate::define('edit-customer', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$EDIT_CUSTOMERS);
        });

        Gate::define('delete-customer', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$DELETE_CUSTOMERS);
        });

        Gate::define('view-expenses', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$VIEW_EXPENSES);
        });

        Gate::define('add-expense', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$ADD_EXPENSES);
        });

        Gate::define('edit-expense', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$EDIT_EXPENSES);
        });

        Gate::define('delete-expense', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$DELETE_EXPENSES);
        });

        Gate::define('view-inventory', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$VIEW_INVENTORY);
        });

        Gate::define('add-inventory', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$ADD_INVENTORY);
        });

        Gate::define('edit-inventory', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$EDIT_INVENTORY);
        });

        Gate::define('delete-inventory', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$DELETE_INVENTORY);
        });

        Gate::define('view-incomes', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$VIEW_INCOMES);
        });

        Gate::define('add-income', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$ADD_INCOME);
        });

        Gate::define('edit-income', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$EDIT_INCOME);
        });

        Gate::define('delete-income', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$DELETE_INCOME);
        });

        Gate::define('sell-product', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$SELL_PRODUCT);
        });

        Gate::define('view-report', function ($user) {
            return $user->role->permissions()->pluck('permission_code')->contains(Permission::$VIEW_REPORT);
        });
    }
}
