<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use App\Models\Customer;

class CustomerManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_customer_can_be_added_to_a_customerlist()
    {
        $response = $this->post('/customer', ['lastname' => "Doe", 'othernames' => 'John', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $this->assertCount(1, Customer::all());
        $response->assertRedirect('/customerlist');
    }
    public function test_a_customer_lastname_is_required()

    {
        $response = $this->post('/customer', ['lastname' => "", 'othernames' => 'John', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $response->assertSessionHasErrors('lastname');
    }
    public function test_a_customer_othernames_is_required()
    {
        $response = $this->post('/customer', ['lastname' => "Doe", 'othernames' => '', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $response->assertSessionHasErrors('othernames');
    }
    public function test_a_customer_phone_is_required()
    {
        $response = $this->post('/customer', ['lastname' => "Doe", 'othernames' => 'John', 'phone' => '', 'email' => 'abc@def.com']);
        $response->assertSessionHasErrors('phone');
    }
    public function test_a_customer_email_is_required()
    {
        $response = $this->post('/customer', ['lastname' => "Doe", 'othernames' => 'John', 'phone' => '0792321223', 'email' => '']);
        $response->assertSessionHasErrors('email');
    }
    public function test_a_customer_detail_can_be_updated()
    {

        $response = $this->post('/customer', ['lastname' => "Doe", 'othernames' => 'John', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $customer = Customer::first();
        $response = $this->patch('/customer/' . $customer->id, ['lastname' => "Doyen", 'othernames' => 'John', 'phone' => '0722321233', 'email' => 'xyz@abc.com']);
        $this->assertEquals('Doyen', $customer->first()->lastname);
        $this->assertEquals('John', $customer->first()->othernames);
        $this->assertEquals('0722321233', $customer->first()->phone);
        $this->assertEquals('xyz@abc.com', $customer->first()->email);
        $response->assertRedirect('/customerlist');
    }
    public function test_a_customer_detail_can_be_deleted()
    {

        $this->post('/customer/', ['lastname' => "Doe", 'othernames' => 'John', 'phone' => '0792321223', 'email' => 'abc@def.com']);
        $customer = Customer::first();

        $response = $this->delete('/customer/' . $customer->id);
        $this->assertCount(0, Customer::all());
        $response->assertRedirect('/customerlist');
    }
}
