<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_be_added_to_a_userlist()
    {
        $response = $this->post('/user', ['familyname' => "Doe", 'othernames' => 'John', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $this->assertCount(1, User::all());
        $response->assertRedirect('/userlist');
    }
    public function test_a_user_familyname_is_required()

    {
        $response = $this->post('/user', ['familyname' => "", 'othernames' => 'John', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $response->assertSessionHasErrors('familyname');
    }
    public function test_a_user_othernames_is_required()
    {
        $response = $this->post('/user', ['familyname' => "Doe", 'othernames' => '', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $response->assertSessionHasErrors('othernames');
    }
    public function test_a_user_phone_is_required()
    {
        $response = $this->post('/user', ['familyname' => "Doe", 'othernames' => 'John', 'phone' => '', 'email' => 'abc@def.com']);
        $response->assertSessionHasErrors('phone');
    }
    public function test_a_user_email_is_required()
    {
        $response = $this->post('/user', ['familyname' => "Doe", 'othernames' => 'John', 'phone' => '0792321223', 'email' => '']);
        $response->assertSessionHasErrors('email');
    }
    public function test_a_user_detail_can_be_updated()
    {

        $response = $this->post('/user', ['familyname' => "Doe", 'othernames' => 'John', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $user = User::first();
        $response = $this->patch('/user/' . $user->id, ['familyname' => "Doyen", 'othernames' => 'John', 'phone' => '0722321233', 'email' => 'xyz@abc.com']);
        $this->assertEquals('Doyen', $user->first()->familyname);
        $this->assertEquals('John', $user->first()->othernames);
        $this->assertEquals('0722321233', $user->first()->phone);
        $this->assertEquals('xyz@abc.com', $user->first()->email);
        $response->assertRedirect('/userlist');
    }
    public function test_a_user_detail_can_be_deleted()
    {

        $this->post('/user/', ['familyname' => "Doe", 'othernames' => 'John', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $user = User::first();

        $response = $this->delete('/user/' . $user->id);
        $this->assertCount(0, User::all());
        $response->assertRedirect('/userlist');
    }
}
