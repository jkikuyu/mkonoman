<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Contractor;

class ContractorManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_contractor_can_be_added_to_the_contractor_list()
    {
        //$this->withoutExceptionHandling();
        $response = $this->post('/contractor/', ['lastname' => 'Doe', 'othernames' => 'John', 'jobtype' => '1']);
        $this->assertCount('1', Contractor::all());
        $response->assertRedirect('/contractorlist');
    }
    public function test_a_contractor_lastname_is_required()
    {
        $response = $this->post('/contractor/', ['lastname' => '', 'othernames' => 'John', 'jobtype' => '1']);
        $response->assertSessionHasErrors('lastname');
    }
    public function test_a_contractor_othernames_is_required()
    {
        $response = $this->post('/contractor/', ['lastname' => 'Doe', 'othernames' => '', 'jobtype' => '1']);
        $response->assertSessionHasErrors('othernames');
    }
    public function test_a_contractor_jobtype_is_required()
    {
        $response = $this->post('/contractor/', ['lastname' => 'Doe', 'othernames' => 'John', 'jobtype' => '']);
        $response->assertSessionHasErrors('jobtype');
    }

    public function test_a_contractor_details_can_be_updated()
    {
        $response = $this->post('/contractor/', ['lastname' => 'Doe', 'othernames' => 'John', 'jobtype' => '1']);

        $contractor = Contractor::first();
        $response = $this->patch('/contractor/' . $contractor->id, ['lastname' => 'Doyen', 'othernames' => 'John', 'jobtype' => '2']);

        $this->assertequals('Doyen', $contractor->first()->lastname);
        $this->assertequals('John', $contractor->first()->othernames);
        $this->assertequals('2', $contractor->first()->jobtype);
        $response->assertRedirect('/contractorlist');
    }
    public function test_a_contractor_can_be_deleted()
    {
        $response = $this->post('/contractor/', ['lastname' => 'Doe', 'othernames' => 'John', 'jobtype' => '1', 'experience' => '10']);

        $contractor = Contractor::first();
        $response = $this->delete('/contractor/' . $contractor->id, ['lastname' => 'Doyen', 'othernames' => 'John', 'jobtype' => '2', 'experience' => '15']);

        $response->assertRedirect('/contractorlist');
    }
}
