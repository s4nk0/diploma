<x-admin.user.profile-layout :user="$user">
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Profile Details</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <a href="{{route('admin.user.edit',['user'=>$user])}}" class="btn btn-primary align-self-center">Edit Profile</a>
            <!--end::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Name</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{$user->name}}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        @if($user->email)
            <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Email</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{$user->email}}</span>
                        @isset($user->email_verified_at)
                            <span class="badge badge-success">Verified</span>
                            @endisset
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
        @endif
        @if($user->phone_number)
            <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Contact Phone</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fw-bolder fs-6 text-gray-800 me-2">{{$user->phone_number}}</span>
                        <span class="badge badge-success">Verified</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
        @endif
        @if($user->gender)
            <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Gender</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800 me-2">{{$user->gender->title}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            @endif
        </div>
        <!--end::Card body-->
    </div>
</x-admin.user.profile-layout>
