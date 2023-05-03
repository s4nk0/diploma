<x-admin-layout>
    <form method="POST" action="{{ route('admin.user.store') }}">
        @csrf

        <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Create user</h3>
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
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Name</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                    <input id="name" type="text" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        @error('name')
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input id="email" type="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required PLACEHOLDER="Email" autocomplete="email">
                            <div class="fv-plugins-message-container invalid-feedback">
                                @error('email')
                                {{$message}}
                                @enderror
                            </div></div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Phone</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input  id="phone_number" type="text" class="form-control form-control-lg form-control-solid @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone') }}" required PLACEHOLDER="Phone" autocomplete="phone_number">
                            <div class="fv-plugins-message-container invalid-feedback">
                                @error('phone_number')
                                {{$message}}
                                @enderror
                            </div></div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                @if($genders->count())
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Gender</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">

                            @foreach($genders as $gender)
                                <label class="form-check form-check-inline form-check-solid ">
                                    <input type="radio" class="form-check-input @error('gender_id') is-invalid @enderror" name="gender_id" value="{{$gender->id}}" id="gender_{{$gender->id}}" autocomplete="off">
                                    <span class="fw-bold ps-2 fs-6">{{$gender->title}}</span>
                                </label>
                            @endforeach

                            <div class="fv-plugins-message-container invalid-feedback">
                                @error('gender_id')
                                {{$message}}
                                @enderror
                            </div></div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                @endif

                <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Password</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input id="password" type="password" class="form-control form-control-lg form-control-solid  @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                            <div class="fv-plugins-message-container invalid-feedback">
                                @error('password')
                                {{$message}}
                                @enderror
                            </div></div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Confirm password</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input id="password-confirm" type="password" class="form-control form-control form-control-lg form-control-solid" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                            <div class="fv-plugins-message-container invalid-feedback">
                                @error('password_confirmation')
                                {{$message}}
                                @enderror
                            </div></div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Create</button>
                </div>
                <!--end::Actions-->
                <input type="hidden"><div></div></form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    </form>
</x-admin-layout>
