@extends('layout.master')

@section('title','ایجاد پروژه')


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ایجاد پروژه</h1>

        </div>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Content Row -->

        <div class="row">

            <x-ui.wrapper :title="'فرم پروژه'" :col="'12'">


                <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <x-ui.input :name="'name'" :label="'نام'" :id="'name'" :type="'text'" :value="''"/>

                        </div>
                        <div class="col-md-6">
                            @php
                                $options = [
                                    ['value' => 'store', 'name' => 'فروشگاهی'],
                                    ['value' => 'company', 'name' => 'شرکتی']
                                ];
                            @endphp

                            <x-ui.select-input name="type" label="نوع سایت" id="type" :options="$options"
                                               :selected="''"/>

                        </div>
                        <div class="col-md-6">
                            @php
                                $options = [
                                    ['value' => 'basic', 'name' => 'پایه'],
                                    ['value' => 'pro', 'name' => 'حرفه ای'],
                                    ['value' => 'vip', 'name' => 'vip'],
                                    ['value' => 'elite', 'name' => 'الیت']
                                ];
                            @endphp

                            <x-ui.select-input name="plan" label="پلن" id="plan" :options="$options"
                                               :selected="''"/>

                        </div>
                        <div class="col-md-6">

                            <x-ui.input :name="'figma_count'" :label="'تعداد فیگما'" :id="'figma_count'"
                                        :type="'number'"
                                        :value="''"/>

                        </div>
                        <div class="col-md-6">
                            <x-ui.input :name="'days'" :label="'تعداد روزکاری'" :id="'days'" :type="'number'"
                                        :value="''"/>

                        </div>
                        <div class="col-md-6">
                            <x-ui.datepicker :name="'delivery_date'" :label="'تاریخ الزام به تحویل'" :id="'delivery_date'" :value="''"/>

                        </div>
                    </div>




                    <button type="submit" class="btn btn-primary">مرحله بعد</button>
                </form>


            </x-ui.wrapper>


        </div>


    </div>
    <!-- /.container-fluid -->

@endsection



@section('script')
{{--    <script src="{{asset('sb2/js/jalaali.min.js')}}"></script>--}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const days = document.getElementById("days");
            const delivery_date = document.getElementById("delivery_date");

            days.addEventListener("input", function () {
                let days_count = days.value;
                if (days_count) {
                    loadDate(days_count);
                }
            });


            function loadDate(days_count) {
                fetch(`/date/${days_count}`)
                    .then(response => response.json())
                    .then(data => {
                        delivery_date.value = data.date; // مقداردهی صحیح
                    })
                    .catch(error => {
                        console.error("Error fetching times:", error);
                    });
            }


        });


    </script>
@endsection
