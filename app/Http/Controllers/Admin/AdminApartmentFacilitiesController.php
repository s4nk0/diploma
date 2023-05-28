<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentFacilities\StoreApartmentFacilitiesRequest;
use App\Http\Requests\Admin\ApartmentFacilities\UpdateApartmentFacilitiesRequest;
use App\Models\ApartmentFacilities;

class AdminApartmentFacilitiesController extends Controller
{
    public function index()
    {
        $apartmentFacilities = ApartmentFacilities::paginate(5);
        return view('admin.apartmentFacilities.index',compact('apartmentFacilities'));
    }

    public function create()
    {
        return view('admin.apartmentFacilities.create');
    }

    public function store(StoreApartmentFacilitiesRequest $request)
    {
        ApartmentFacilities::create($request->validated());
        return redirect()->route('admin.apartmentFacility.index');
    }

    public function show(ApartmentFacilities $apartmentFacilities)
    {
        //
    }

    public function edit(ApartmentFacilities $apartmentFacility)
    {
        return view('admin.apartmentFacilities.edit',compact('apartmentFacility'));
    }

    public function update(UpdateApartmentFacilitiesRequest $request, ApartmentFacilities $apartmentFacility)
    {
        $apartmentFacility->update($request->validated());
        return redirect()->route('admin.apartmentFacility.index');
    }

    public function destroy(ApartmentFacilities $apartmentFacility)
    {
        $apartmentFacility->delete();
        return redirect()->route('admin.apartmentFacility.index');
    }
}
