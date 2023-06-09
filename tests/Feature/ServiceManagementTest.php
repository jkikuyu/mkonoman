<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Service;

class ServiceManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_service_can_be_added_to_the_service_list()
    {
        //$this->withoutExceptionHandling();
        $response =  $this->post('/servicelist', ["name" => "Tap Repair", "description" => "fix the tap"]);

        $this->assertCount(1, Service::all());
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

        $response =  $this->post('/servicelist', ["name" => "Water Leak", "description" => ""]);
        $response->assertSessionHasErrors('description');
    }
    /** @test */
    public function a_service_can_be_updated()
    {


        $this->post('/servicelist', ["name" => "Water Leak", "description" => "fix the tap"]);
        $service = Service::first();
        $response = $this->patch('/servicelist/' . $service->id, ["name" => "Fosset Repair", "description" => "fix the fosset"]);
        $this->assertEquals('Fosset Repair', $service->first()->name);
        $this->assertEquals('fix the fosset', $service->first()->description);
        $response->assertRedirect('/servicelist');
    }

    public function test_a_repair_service_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->post('/servicelist', ["name" => "Water Leak", "description" => "fix the tap"]);
        $service = Service::first();
        $response = $this->delete('/servicelist/' . $service->id);
        $this->assertCount(0, Service::all());
        $response->assertRedirect('/servicelist');
    }
}
