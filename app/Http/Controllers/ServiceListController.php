<?php

namespace App\Http\Controllers;

use App\Models\RepairService;
use Illuminate\Http\Request;

class ServiceListController extends Controller
{
    //
    public function store()
    {
        RepairService::create($this->validateRequest());
    }
    public function update(RepairService $repairService)
    {
        $data = $this->validateRequest();

        $repairService->update($this->validateRequest());
    }
    protected function validateRequest()
    {
        return request()->validate(['name' => 'required', 'description' => 'required']);
    }
}
