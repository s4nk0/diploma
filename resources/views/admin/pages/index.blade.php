<x-admin-layout>
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack bg-white mb-3 py-5 rounded-top">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
    </div>
    <div class="row g-5 g-lg-10 mb-10">
        <div class="col-md-6 col-xl-6 mb-md-5 mb-xxl-10">
            <!--begin::Card widget 8-->
            <div class="card overflow-hidden h-md-50 mb-5 mb-lg-10">
                <!--begin::Card body-->
                <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                    <!--begin::Statistics-->
                    <div class="mb-4 px-9">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Currency-->
                            <span class="fs-4 fw-bold text-gray-400 align-self-start me-1>"></span>
                            <!--end::Currency-->
                            <!--begin::Value-->
                            <span class="fs-2hx fw-bolder text-gray-800 me-2 lh-1">{{$userCount}}</span>
                            <!--end::Value-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-bold text-gray-400">Количество пользователей</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 8-->
            <!--begin::Card widget 5-->
            <div class="card card-flush h-md-50 mb-lg-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bolder text-dark me-2 lh-1">{{$adCount}}</span>
                            <!--end::Amount-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-bold fs-6">{{__('ad.search_ad')}}</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
            </div>
            <!--end::Card widget 5-->
        </div>
        <div class="col-md-6 col-xl-6 mb-md-5 mb-xxl-10">
            <!--begin::Card widget 9-->
            <div class="card overflow-hidden h-md-50 mb-5 mb-lg-10">
                <!--begin::Card body-->
                <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                    <!--begin::Statistics-->
                    <div class="mb-4 px-9">
                        <!--begin::Statistics-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Currency-->
                            <span class="fs-4 fw-bold text-gray-400 align-self-start me-1>"></span>
                            <!--end::Currency-->
                            <!--begin::Value-->
                            <span class="fs-2hx fw-bolder text-gray-800 me-2 lh-1">{{number_format($viewsCount, 0, '', ', ')}}</span>
                            <!--end::Value-->
                        </div>
                        <!--end::Statistics-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-bold text-gray-400">Просмотры объявления </span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 9-->
            <!--begin::Card widget 7-->
            <div class="card card-flush h-md-50 mb-lg-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Amount-->
                        <span class="fs-2hx fw-bolder text-dark me-2 lh-1">{{$adGetCount}}</span>
                        <!--end::Amount-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-bold fs-6">{{__('ad.get_ad')}}</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
            </div>
            <!--end::Card widget 7-->
        </div>
    </div>

    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-10">
            <!--begin::Chart widget 5-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Больше всего объявлении</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-6">{{__('ad.search_ad')}}</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5 ps-6">
                    <div id="kt_charts_widget_18" class="min-h-auto"></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 5-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-10">
            <!--begin::Chart widget 5-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Больше всего объявлении</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-6">{{__('ad.get_ad')}}</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5 ps-6">
                    <div id="kt_charts_widget_19" class="min-h-auto"></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 5-->
        </div>
        <!--end::Col-->
    </div>

    <x-slot name="script">
        <script>

            var KTChartsWidget18 = {
                init: function () {
                    !(function () {
                        var e = document.getElementById("kt_charts_widget_18");
                        if (e) {
                            var t = KTUtil.getCssVariableValue("--bs-border-dashed-color"),
                                a = {
                                    series: [{ data: [
                                            @foreach($adByCities as $data)
                                                {{$data->count}},
                                            @endforeach
                                        ], show: !1 },],
                                    chart: { type: "bar", height: 500, toolbar: { show: !1 } },
                                    plotOptions: { bar: { borderRadius: 4, horizontal: !0, distributed: !0, barHeight: 23 } },
                                    dataLabels: { enabled: !1 },
                                    legend: { show: !1 },
                                    colors: ["#3E97FF", "#F1416C", "#50CD89", "#FFC700", "#7239EA", "#50CDCD", "#3F4254"],
                                    xaxis: {
                                        categories: [
                                            @foreach($adByCities as $data)
                                            "{{$data->city->title}}",
                                            @endforeach
                                        ],
                                        labels: {
                                            formatter: function (e) {
                                                return e;
                                            },
                                            style: { colors: KTUtil.getCssVariableValue("--bs-gray-400"), fontSize: "14px", fontWeight: "600", align: "left" },
                                        },
                                        axisBorder: { show: !1 },
                                    },
                                    yaxis: { labels: { style: { colors: KTUtil.getCssVariableValue("--bs-gray-800"), fontSize: "14px", fontWeight: "600" }, offsetY: 2, align: "left" } },
                                    grid: { borderColor: t, xaxis: { lines: { show: !0 } }, yaxis: { lines: { show: !1 } }, strokeDashArray: 4 },
                                },
                                r = new ApexCharts(e, a);
                            setTimeout(function () {
                                r.render();
                            }, 300);
                        }
                    })();
                },
            };
            "undefined" != typeof module && (module.exports = KTChartsWidget18),
                KTUtil.onDOMContentLoaded(function () {
                    KTChartsWidget18.init();
                });

            var KTChartsWidget19 = {
                init: function () {
                    !(function () {
                        var e = document.getElementById("kt_charts_widget_19");
                        if (e) {
                            var t = KTUtil.getCssVariableValue("--bs-border-dashed-color"),
                                a = {
                                    series: [{ data: [
                                            @foreach($adGetByCities as $data)
                                                {{$data->count}},
                                            @endforeach
                                        ], show: !1 }],
                                    chart: { type: "bar", height: 500, toolbar: { show: !1 } },
                                    plotOptions: { bar: { borderRadius: 4, horizontal: !0, distributed: !0, barHeight: 23 } },
                                    dataLabels: { enabled: !1 },
                                    legend: { show: !1 },
                                    colors: ["#3E97FF", "#F1416C", "#50CD89", "#FFC700", "#7239EA", "#50CDCD", "#3F4254"],
                                    xaxis: {
                                        categories: [
                                            @foreach($adGetByCities as $data)
                                                "{{$data->city->title}}",
                                            @endforeach
                                        ],
                                        labels: {
                                            formatter: function (e) {
                                                return e;
                                            },
                                            style: { colors: KTUtil.getCssVariableValue("--bs-gray-400"), fontSize: "14px", fontWeight: "600", align: "left" },
                                        },
                                        axisBorder: { show: !1 },
                                    },
                                    yaxis: { labels: { style: { colors: KTUtil.getCssVariableValue("--bs-gray-800"), fontSize: "14px", fontWeight: "600" }, offsetY: 2, align: "left" } },
                                    grid: { borderColor: t, xaxis: { lines: { show: !0 } }, yaxis: { lines: { show: !1 } }, strokeDashArray: 4 },
                                },
                                r = new ApexCharts(e, a);
                            setTimeout(function () {
                                r.render();
                            }, 300);
                        }
                    })();
                },
            };
            "undefined" != typeof module && (module.exports = KTChartsWidget19),
                KTUtil.onDOMContentLoaded(function () {
                    KTChartsWidget19.init();
                });

        </script>
    </x-slot>
</x-admin-layout>
