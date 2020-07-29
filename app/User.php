<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UserTrait;
use App\Role;

class User extends Authenticatable
{
    use Notifiable, UserTrait;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'dni', 'tutor'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function createTestingUsers($role)
    {
        $roles = new Role();
        $roles->createRoles();

        $adminRole=1;
        $professionalRole=2;
        $associatedRole=3;

        if ($role=='admin'){
            factory(User::class)->create(['first_name' => 'Admin', 'last_name' => 'Ramón y Cajal', 'email' => 'admin@tracecatalunya.org', 'phone' => '+34123456779', 'dni' => '12345778A']);
            $user = User::find(1);
            $user->roles()->sync([$adminRole]);
            return $user;
        }
        if ($role=='professional'){
            factory(User::class)->create(['first_name' => 'Professional', 'last_name' => 'Ramón y Cajal', 'email' => 'pro@tracecatalunya.org', 'phone' => '+34123476789', 'dni' => '17345678A']);
            $user = User::find(1);
            $user->roles()->sync([$professionalRole]);
            return $user;
        }
        if ($role=='associated'){
            factory(User::class)->create(['first_name' => 'Associated', 'last_name' => 'Ramón y Cajal', 'email' => 'as@tracecatalunya.org', 'phone' => '+34173456789', 'dni' => '72345678A']);
            $user = User::find(1);
            $user->roles()->sync([$associatedRole]);
            return $user;
        }
    }
}