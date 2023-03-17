<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store()
    {
        Customer::create($this->validRequest());
        return redirect('/customerlist');
    }
    public function update(Customer $customer)
    {
        $customer->update($this->validRequest());
        return redirect('/customerlist');
    }
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('/customerlist');
    }
    private function validRequest()
    {
        return request()->validate(['lastname' => 'required', 'othernames' => 'required', 'phone' => 'required', 'email' => 'required']);
    }
}
