@extends('layout.master')

@section('title','افزودن شهید')

@section('link')
    <link rel="stylesheet" href="{{asset('css/jalalidatepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor.js') }}"></script> <!-- اضافه کردن CKEditor -->

@endsection



@php
    $defaultProvinceId = old('bitrh_province_id') ?? 25; // فرضاً استان با ID=1 پیش‌فرض
@endphp

@section('content')

    <!-- Main page content-->
    <div class="container-xl px-4 is-rtl">



        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card my-4">
            <div class="card-header">افزودن شهدا</div>
            <div class="card-body">
                <form class="row" action="{{ route('shahid.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 col-6">
                        <label for="national_code" class="form-label">کد ملی</label>
                        <input type="text" class="form-control" id="national_code" name="national_code" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="first_name" class="form-label">نام</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="last_name" class="form-label">نام خانوادگی</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="father_name" class="form-label">نام پدر</label>
                        <input type="text" class="form-control" id="father_name" name="father_name">
                    </div>

                    <div class="mb-3 col-6">
                        <label for="birth_date" class="form-label">تاریخ تولد</label>
                        <input type="text" class="form-control" id="martyrdom_date2" name="birth_date" data-jdp>

                    </div>
                    <div class="mb-3 col-6">
                        <label for="martyrdom_date" class="form-label">تاریخ شهادت</label>
                        <input type="text" class="form-control" id="martyrdom_date" name="martyrdom_date" data-jdp>
                    </div>

                    <div class="mb-3 col-6">
                        <label for="cemetery" class="form-label">مزار</label>
                        <input type="text" class="form-control" id="cemetery" name="cemetery">
                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label" for="birth_province_id">استان تولد</label>
                        <select name="birth_province_id" id="provinceSelect" class="form-control">
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" {{ $province->id == $defaultProvinceId ? 'selected' : '' }}>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>



                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label" for="citySelect">شهر تولد</label>

                        <select name="birth_city_id" class="form-control mt-2" id="citySelect">
                            <option value="">ابتدا استان را انتخاب کنید</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label">بخش تولد</label>
                        <input type="text" name="birth_district" class="form-control">

                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label" for="center_city_id">مرکز</label>

                        <select name="center_city_id" class="form-control mt-2" id="centerCitySelect">
                            @foreach($center_cities as $city)
                                <option value="{{ $city->id }}">
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">

                    </div>
                    <div class="mb-3 col-3">
                        <label for="image-dropzone" class="form-label">تصویر شهید</label>
                        <div class="dropzone form-control" id="image-dropzone"></div>
                        <input name="profile_image" id="profile_image" type="hidden">
                    </div>

                    <div class="mb-3 col-9">
                        <label class="form-label" for="gallery-dropzone">گالری تصاویر</label>
                        <div class="dropzone form-control" id="gallery-dropzone"></div>
                        <div id="gallery-hidden-inputs"></div>
                    </div>
                    <!-- زندگی‌نامه -->
                    <div class="mb-3 col-12">
                        <label for="biography" class="form-label">زندگی‌نامه</label>
                        <textarea class="form-control" id="biography" name="biography" rows="6">{{ old('biography', $shahid->biography ?? '') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">ثبت</button>
                </form>

            </div>
        </div>

    </div>
@endsection


@section('script')
    <script src="{{asset('js/jalalidatepicker.min.js')}}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#biography'), {
                language: 'fa',  // زبان فارسی (راست به چپ)
            })
            .catch(error => {
                console.error(error);
            });

        jalaliDatepicker.startWatch(); // اگر از startWatch استفاده می‌کنید و attribute لازم رو ست کرده‌اید
        Dropzone.autoDiscover = false;

        const imageDropzone = new Dropzone("#image-dropzone", {
            url: "{{ route('upload.image') }}",
            maxFiles: 1, // ❗ فقط 1 فایل مجاز
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            dictDefaultMessage: "تصویر شاخص",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                document.getElementById('profile_image').value = response.url;
            },
            maxFilesize: 2, // حداکثر سایز هر تصویر (مگابایت)
            init: function () {
                this.on("maxfilesexceeded", function (file) {
                    // اگر قبلاً فایلی انتخاب شده، اون رو حذف کن و فایل جدید رو اضافه کن
                    this.removeAllFiles();
                    this.addFile(file);
                });
            }
        });
        Dropzone.autoDiscover = false;

        const galleryDropzone = new Dropzone("#gallery-dropzone", {
            url: "{{ route('gallery.upload') }}",
            acceptedFiles: "image/*",
            maxFilesize: 4,
            addRemoveLinks: true,
            dictDefaultMessage: "چند تصویر را بکشید یا انتخاب کنید",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                // ذخیره آدرس تصویر در فایل برای استفاده بعدی در حذف
                file.uploadedPath = response.path;

                // ساخت input پنهان و اضافه به فرم
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'gallery_paths[]';
                input.value = response.path;
                input.dataset.dzPath = response.path; // برای شناسایی راحت هنگام حذف
                document.getElementById('gallery-hidden-inputs').appendChild(input);
            },
            removedfile: function (file) {
                // حذف input مربوط به تصویر
                const path = file.uploadedPath;
                const inputs = document.querySelectorAll('input[name="gallery_paths[]"]');
                inputs.forEach(input => {
                    if (input.dataset.dzPath === path) {
                        input.remove();
                    }
                });

                // حذف UI
                const preview = file.previewElement;
                if (preview != null && preview.parentNode != null) {
                    preview.parentNode.removeChild(preview);
                }
            }
        });



        $(document).ready(function () {
            let provinceId = $('#provinceSelect').val();
            let selectedCityId = '{{ old('bitrh_city_id') }}';

            function loadCities(provinceId, selectedCityId = null) {
                $.ajax({
                    url: '/get-cities/' + provinceId,
                    type: 'GET',
                    success: function (cities) {
                        let citySelect = $('#citySelect');
                        citySelect.empty();
                        if (cities.length > 0) {
                            citySelect.append('<option value="">انتخاب شهر</option>');
                            $.each(cities, function (index, city) {
                                let selected = (city.id == selectedCityId) ? 'selected' : '';
                                citySelect.append('<option value="' + city.id + '" ' + selected + '>' + city.name + '</option>');
                            });
                        } else {
                            citySelect.append('<option value="">شهری یافت نشد</option>');
                        }
                    }
                });
            }

            // بارگذاری اولیه هنگام لود صفحه
            if (provinceId) {
                loadCities(provinceId, selectedCityId);
            }

            // هنگام تغییر استان
            $('#provinceSelect').on('change', function () {
                loadCities($(this).val());
            });
        });

    </script>

@endsection
