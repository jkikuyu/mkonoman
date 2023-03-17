<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function store()
    {
        Contractor::create($this->validrequest());
        return redirect('/contractorlist');
    }
    private function validrequest()
    {
        return request()->validate(['lastname' => 'required', 'othernames' => 'required', 'jobtype' => 'required']);
    }
    public function update(Contractor $contractor)
    {
        $contractor->update($this->validrequest());
        return redirect('/contractorlist');
    }
    public function destroy(Contractor $contractor)
    {
        $contractor->delete();
        return redirect('/contractorlist');
    }
}
