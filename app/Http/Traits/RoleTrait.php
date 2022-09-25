<?php

namespace App\Http\Traits;

use App\Models\Role;
use App\Models\User;

trait RoleTrait
{
    /**
     * Get First Role
     *
    */
    public function getFirstRole()
    {
        $role = Role::firstOrFail();
        if(!$role){
            $this->createIfNotExist();
        }
        return $role;
    }

    /**
     * Let's assign new role for the user
     *
     * @param $user
     * @param $role
     * @return void
     */
    public function assignRole($user, $role): void
    {
        $firstUser = User::firstOrFail();
        $userRole = User::where('slug', '=', 'user')->first();
        if($firstUser) {
            $firstUser->id === $user->id ? $user->roles()->attach([$role->id]) : $user->roles()->attach([$userRole->id]);
        }
    }

    /**
     * Create a new role for the user
     *
     * @return void
     */
    public function createIfNotExist(): void
    {
        $roles = [
            ['title' => 'Admin', 'slug' => 'admin'],
            ['title' => 'User', 'slug' => 'user', ],
        ];

        foreach ($roles as $role){
            Role::create($role);
        }
    }
}
