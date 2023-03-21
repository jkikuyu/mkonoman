<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuotationManagementTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_quotation_can_be_prepared()
    {
        $customer = factory(Customer::class)->create();
        $repairservice = factory(RepairService::class)->create();
        $repairservice->makeQuotation($customer);
        $this->assertEquals($customer_id, Quotation::first()->customer_id);
        $this->assertEquals($repairservice_id, Quotation::first()->repairservice_id);
        $this->assertEquals(now(), Quotation::first()->created_at);
    }
}
