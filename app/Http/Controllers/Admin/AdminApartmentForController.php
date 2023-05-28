<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentFor\StoreApartmentForRequest;
use App\Http\Requests\Admin\ApartmentFor\UpdateApartmentForRequest;
use App\Models\ApartmentFor;

class AdminApartmentForController extends Controller
{
    public function index()
    {
        $apartmentFor = ApartmentFor::paginate(5);
        return view('admin.apartmentFor.index',compact('apartmentFor'));
    }

    public function create()
    {
        return view('admin.apartmentFor.create');
    }

    public function store(StoreApartmentForRequest $request)
    {
        ApartmentFor::create($request->validated());
        return redirect()->route('admin.apartmentFor.index');
    }

    public function show(ApartmentFor $apartmentFor)
    {
        //
    }

    public function edit(ApartmentFor $apartmentFor)
    {
        return view('admin.apartmentFor.edit',compact('apartmentFor'));
    }

    public function update(UpdateApartmentForRequest $request, ApartmentFor $apartmentFor)
    {
        $apartmentFor->update($request->validated());
        return redirect()->route('admin.apartmentFor.index');
    }

    public function destroy(ApartmentFor $apartmentFor)
    {
        $apartmentFor->delete();
        return redirect()->route('admin.apartmentFor.index');
    }
}
