<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentCondition\StoreApartmentConditionRequest;
use App\Http\Requests\Admin\ApartmentCondition\UpdateApartmentConditionRequest;
use App\Models\ApartmentCondition;

class AdminApartmentConditionController extends Controller
{

    public function index()
    {
        $apartmentConditions = ApartmentCondition::paginate(5);
        return view('admin.apartmentCondition.index', compact('apartmentConditions'));
    }

    public function create()
    {
        return view('admin.apartmentCondition.create');
    }

    public function store(StoreApartmentConditionRequest $request)
    {
        ApartmentCondition::create($request->validated());
        return redirect()->route('admin.apartmentCondition.index');
    }

    public function show(ApartmentCondition $apartmentCondition)
    {

    }

    public function edit(ApartmentCondition $apartmentCondition)
    {
        return view('admin.apartmentCondition.edit',compact('apartmentCondition'));
    }

    public function update(UpdateApartmentConditionRequest $request, ApartmentCondition $apartmentCondition)
    {
        $apartmentCondition->update($request->validated());
        return redirect()->route('admin.apartmentCondition.index');
    }


    public function destroy(ApartmentCondition $apartmentCondition)
    {
        $apartmentCondition->delete();
        return redirect()->route('admin.apartmentCondition.index');
    }
}
