<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\RepairService;

class RepairServiceTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_repair_service_can_be_added_to_the_service_list()
    {
        $this->withoutExceptionHandling();

        $response =  $this->post('/servicelist', ["name" => "Tap Repair", "description" => "fix the tap"]);

        $response->assertOk();
        $this->assertCount(1, RepairService::all());
    }

    /** @test */
    public function a_service_list_name_is_required()
    {
        //$this->withoutExceptionHandling();

        $response =  $this->post('/servicelist', ["name" => "", "description" => "fix the tap"]);
        $response->assertSessionHasErrors('name');
    }
    /** @test */
    public function a_service_list_description_is_required()
    {

        $response =  $this->post('/servicelist', ["name" => "Tap repair", "description" => ""]);
        $response->assertSessionHasErrors('description');
    }
    /** @test */
    public function a_service_list_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/servicelist', ["name" => "Tap Repair", "description" => "fix the tap"]);
        $repairservice = RepairService::first();
        $response = $this->patch('/servicelist/' . $repairservice->id, ["name" => "Fosset Repair", "description" => "fix the fosset"]);
        $this->assertEquals('Fosset Repair', $repairservice->first()->name);
        $this->assertEquals('fix the fosset', $repairservice->first()->description);
    }
}
