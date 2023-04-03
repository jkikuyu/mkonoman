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
    public function test_a_customer_can_make_a_service_request()
    {
        $user = UserFactory(User::class)->create();
        $quotation = QuotationFactory(Quotation::class)->create();
    }
    public function test_a_customer_makes_a_quotation_request()
    {
    }
}
