<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentFurniture\StoreApartmentFurnitureRequest;
use App\Http\Requests\Admin\ApartmentFurniture\UpdateApartmentFurnitureRequest;
use App\Models\ApartmentFurniture;

class AdminApartmentFurnitureController extends Controller
{
    public function index()
    {
        $apartmentFurniture = ApartmentFurniture::paginate(5);
        return view('admin.apartmentFurniture.index',compact('apartmentFurniture'));
    }

    public function create()
    {
        return view('admin.apartmentFurniture.create');
    }

    public function store(StoreApartmentFurnitureRequest $request)
    {
        ApartmentFurniture::create($request->validated());
        return redirect()->route('admin.apartmentFurniture.index');
    }

    public function show(ApartmentFurniture $apartmentFurniture)
    {
        //
    }

    public function edit(ApartmentFurniture $apartmentFurniture)
    {
        return view('admin.apartmentFurniture.edit',compact('apartmentFurniture'));
    }

    public function update(UpdateApartmentFurnitureRequest $request, ApartmentFurniture $apartmentFurniture)
    {
        $apartmentFurniture->update($request->validated());
        return redirect()->route('admin.apartmentFurniture.index');
    }

    public function destroy(ApartmentFurniture $apartmentFurniture)
    {
        $apartmentFurniture->delete();
        return redirect()->route('admin.apartmentFurniture.index');
    }
}
