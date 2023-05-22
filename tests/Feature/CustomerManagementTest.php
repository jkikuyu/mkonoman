<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use App\Models\Service;

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
        $what = Service::factory(1)->has(Service::factory()->hasServices(10), 'services')->make();
        // = $this->post('/servicetype',);
        dd($what);
        //$quotation = QuotationFactory(Quotation::class)->create();
    }
    public function test_a_customer_makes_a_quotation_request()
    {
    }
}
