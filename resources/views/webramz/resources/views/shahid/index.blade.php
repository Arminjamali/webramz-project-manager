@extends('layout.master')

@section('title','لیست شهدا')


@section('content')

    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10 is-rtl">


        <h1>نتایج جستجو</h1>


            <div class="card mb-4">
                <div class="card-header">مدیریت شهدا</div>
                <div class="card-body">
                    <table id="shahids-table" class="display">
                        <thead>
                        <tr>
                            <th>کدملی</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>نام پدر</th>
                            <th>تاریخ تولد</th>
                            <th>تاریخ شهادت</th>
                            <th>شهر تولد</th>
                            <th>مرکز</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

    </div>
@endsection


@section('script')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $('#shahids-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("shahid.index") }}',
            responsive: true,
            stateSave: true, // ✨ این خط مهمه
            pageLength: 10,
            columns: [
                { data: 'national_code', name: 'national_code' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'father_name', name: 'father_name' },
                { data: 'birth_date', name: 'birth_date' },
                { data: 'martyrdom_date', name: 'martyrdom_date' },
                // { data: 'birth_province_name', name: 'birthProvince.name' },
                { data: 'birth_city_name', name: 'birthCity.name' },
                { data: 'center_city_name', name: 'centerCity.name' },
                // { data: 'cemetery', name: 'cemetery' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                paginate: {
                    previous: "‹",
                    next: "›"
                },
                search: "جستجو:",
                lengthMenu: "نمایش _MENU_ رکورد",
                info: "نمایش _START_ تا _END_ از _TOTAL_",
                zeroRecords: "هیچ داده‌ای یافت نشد"
            }
        });

    </script>


@endsection
