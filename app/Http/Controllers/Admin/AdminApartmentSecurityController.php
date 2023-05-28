<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentSecurity\StoreApartmentSecurityRequest;
use App\Http\Requests\Admin\ApartmentSecurity\UpdateApartmentSecurityRequest;
use App\Models\ApartmentSecurity;

class AdminApartmentSecurityController extends Controller
{
    public function index()
    {
        $apartmentSecurities = ApartmentSecurity::paginate(5);
        return view('admin.apartmentSecurity.index',compact('apartmentSecurities'));
    }

    public function create()
    {
        return view('admin.apartmentSecurity.create');
    }

    public function store(StoreApartmentSecurityRequest $request)
    {
        ApartmentSecurity::create($request->validated());
        return redirect()->route('admin.apartmentSecurity.index');
    }

    public function show(ApartmentSecurity $apartmentSecurity)
    {

    }

    public function edit(ApartmentSecurity $apartmentSecurity)
    {
        return view('admin.apartmentSecurity.edit',compact('apartmentSecurity'));
    }

    public function update(UpdateApartmentSecurityRequest $request, ApartmentSecurity $apartmentSecurity)
    {
        $apartmentSecurity->update($request->validated());
        return redirect()->route('admin.apartmentSecurity.index');
    }

    public function destroy(ApartmentSecurity $apartmentSecurity)
    {
        $apartmentSecurity->delete();
        return redirect()->route('admin.apartmentSecurity.index');
    }
}
