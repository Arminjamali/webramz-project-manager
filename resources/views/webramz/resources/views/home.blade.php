@extends('layout.master')

@section('title','نوید شاهد')


@section('content')

    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="bx bx-pulse"></i></div>
                            داشبورد مدیریتی
                        </h1>
                        <div class="page-header-subtitle">نمونه داشبورد مدیریتی پیشفرض</div>
                    </div>
                    <div class="col-12 col-xl-auto mt-4">
                        <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                            <span class="input-group-text col-md-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-calendar text-primary"><rect
                                        x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2"
                                                                                                      x2="16"
                                                                                                      y2="6"></line><line
                                        x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>

                            <input class="form-control ps-0 pointer d-inline-flex col-md-5" id="litepickerRangePluginAz"
                                   placeholder="از">
                            <input class="form-control ps-0 pointer d-inline-flex col-md-5" id="litepickerRangePluginTo"
                                   placeholder="- تا">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10 is-rtl">


    </div>
@endsection

@section('link')

@endsection
@section('script')



@endsection
