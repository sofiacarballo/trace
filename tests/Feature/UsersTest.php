<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Role;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    
    // Admin tests
    public function test_admin_user_role_is_not_empty()
    {
        $role = factory(Role::class)->states('Admin')->create();
        $user = factory(User::class)->states('Admin')->create();
        $userRole = empty($user->role_id);
        
        $expectedReturn = false;

        $this->assertEquals($userRole, $expectedReturn);
    }

    public function test_genuine_dashboard_page_displayed_to_admin_user()
    {
        $role = factory(Role::class)->states('Admin')->create();
        $user = factory(User::class)->states('Admin')->create();
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertSee('Selecciona en el panell');
    }

    // public function test_Admin_can_add_a_new_user()
    // {
    //     $role = factory(Role::class)->states('Admin')->create();
    //     $user = factory(User::class)->states('Admin')->create();
    //     $response = $this->actingAs($user)->post('/user', [
    //         'first_name'=>'Pep',
    //         'last_name'=>'Vilanova',
    //         'email' =>'pep.vilanova@example.com',
    //         'password' =>'password',
    //         'phone' =>'555666777',
    //         'dni'=>'45632178Q',
    //         'tutor' =>'Selma',
    //         'role_id' => '1'
    //     ]);
    //     $this->assertDatabaseHas('users',[
    //         'first_name'=>'Pep',
    //         'last_name'=>'Vilanova',
    //         'email' =>'pep.vilanova@example.com',
    //         'phone' =>'555666777',
    //         'dni'=>'45632178Q',
    //         'tutor' =>'Selma',
    //         'role_id' => '1'
    //     ]);
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/user');
    // }

    // PROFESSIONAL tests
    public function test_professional_user_role_is_not_empty()
    {
        $role = factory(Role::class)->states('Professional')->create();
        $user = factory(User::class)->states('Professional')->create();
        $userRole = empty($user->role_id);
        
        $expectedReturn = false;

        $this->assertEquals($userRole, $expectedReturn);
    }

    public function test_genuine_dashboard_page_displayed_to_professional_user()
    {
        $role = factory(Role::class)->states('Professional')->create();
        $user = factory(User::class)->states('Professional')->create();
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertSee('Selecciona en el panell');
    }

    // SOCI tests
    public function test_genuine_dashboard_page_displayed_to_soci_user()
    {
        $role = factory(Role::class)->states('Soci')->create();
        $user = factory(User::class)->states('Soci')->create();
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertSee('El meu pla de treball');
    }
    
}
