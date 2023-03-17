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
        return redirect('/servicelist');
    }

    public function update(RepairService $repairService)
    {
        $data = $this->validateRequest();

        $repairService->update($this->validateRequest());
        return redirect('/servicelist');
    }
    public function destroy(RepairService $repairService)
    {
        $repairService->delete();
        return redirect('/servicelist');
    }
    protected function validateRequest()
    {
        return request()->validate(['name' => 'required', 'description' => 'required']);
    }
}
