<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdGenderType\StoreAdGenderTypeRequest;
use App\Http\Requests\Admin\AdGenderType\UpdateAdGenderTypeRequest;
use App\Models\AdGenderType;

class AdminAdGenderTypeController extends Controller
{
    public function index()
    {
        $adGenderTypes = AdGenderType::paginate(5);
        return view('admin.adGenderType.index',compact('adGenderTypes'));
    }

    public function create()
    {
        return view('admin.adGenderType.create');
    }

    public function store(StoreAdGenderTypeRequest $request)
    {
        AdGenderType::create($request->validated());
        return redirect()->route('admin.adGenderType.index');
    }

    public function show(AdGenderType $adGenderType)
    {
        //
    }

    public function edit(AdGenderType $adGenderType)
    {
        return view('admin.adGenderType.edit',compact('adGenderType'));
    }

    public function update(UpdateAdGenderTypeRequest $request, AdGenderType $adGenderType)
    {
        $adGenderType->update($request->validated());
        return redirect()->route('admin.adGenderType.index');
    }

    public function destroy(AdGenderType $adGenderType)
    {
        $adGenderType->delete();
        return redirect()->route('admin.adGenderType.index');
    }
}
