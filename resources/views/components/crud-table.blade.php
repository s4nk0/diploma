<div class="card card-xl-stretch mb-5 mb-xl-8 py-5 mt-3">
@isset($header)

    <!--begin::Header-->
        <div class="card-header d-block border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{$header}}</span>
                {{--            <span class="text-muted mt-1 fw-bold fs-7">Over 500 members</span>--}}
            </h3>

            @isset($header_button)
                {{$header_button}}
            @endisset
        </div>
        <!--end::Header-->
@endisset
<!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                {{$slot}}
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
    @isset($pagination)
        {{$pagination}}
    @endisset
</div>
