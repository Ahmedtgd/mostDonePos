<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index' , compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                       
       
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password= $request->password;
        $customer->phone= $request->phone;
        $customer->address= $request->address;

        $customer->save();
         
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.index', compact('customer'));     

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password= $request->password;
        $customer->phone= $request->phone;
        $customer->address= $request->address;

        $customer->save();
         
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
