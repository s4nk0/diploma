<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentFurnitureStatus\StoreApartmentFurnitureStatusRequest;
use App\Http\Requests\Admin\ApartmentFurnitureStatus\UpdateApartmentFurnitureStatusRequest;
use App\Models\ApartmentFurnitureStatus;

class AdminApartmentFurnitureStatusController extends Controller
{
    public function index()
    {
        $apartmentFurnitureStatuses = ApartmentFurnitureStatus::paginate(5);
        return view('admin.apartmentFurnitureStatus.index',compact('apartmentFurnitureStatuses'));
    }

    public function create()
    {
        return view('admin.apartmentFurnitureStatus.create');
    }

    public function store(StoreApartmentFurnitureStatusRequest $request)
    {
        ApartmentFurnitureStatus::create($request->validated());
        return redirect()->route('admin.apartmentFurnitureStatus.index');
    }

    public function show(ApartmentFurnitureStatus $apartmentFurnitureStatus)
    {
        //
    }

    public function edit(ApartmentFurnitureStatus $apartmentFurnitureStatus)
    {
        return view('admin.apartmentFurnitureStatus.edit',compact('apartmentFurnitureStatus'));
    }

    public function update(UpdateApartmentFurnitureStatusRequest $request, ApartmentFurnitureStatus $apartmentFurnitureStatus)
    {
        $apartmentFurnitureStatus->update($request->validated());
        return redirect()->route('admin.apartmentFurnitureStatus.index');
    }

    public function destroy(ApartmentFurnitureStatus $apartmentFurnitureStatus)
    {
        $apartmentFurnitureStatus->delete();
        return redirect()->route('admin.apartmentFurnitureStatus.index');
    }
}
