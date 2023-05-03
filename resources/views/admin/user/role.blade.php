<x-admin-layout>
    <form method="POST" action="{{ route('admin.user.role.update',['user'=>$user]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="number" name="user_id" value="{{$user->id}}" hidden>
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0 d-flex justify-content-between w-100">
                    <h3 class="fw-bolder m-0">Edit user role - {{$user->name}}</h3>


                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">Role</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Role of user"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <select name="roles[]" multiple aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-solid form-select-lg fw-bold">
                                    @if($roles->count())
                                        @foreach($roles as $data)
                                            <option value="{{$data->id}}" {{(in_array($data->id,$userRoles) ? 'selected' : '')}}>{{$data->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-between py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Submit</button>

                    </div>
                    <!--end::Actions-->
                    <input type="hidden"><div></div></form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </form>
</x-admin-layout>
