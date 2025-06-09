@extends('layout.master')

@section('title', 'ویرایش شهید')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/jalalidatepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor.js') }}"></script> <!-- اضافه کردن CKEditor -->

@endsection

@section('content')
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
            <div class="card-header">ویرایش اطلاعات شهید</div>
            <div class="card-body">
                <form method="POST" action="{{ route('shahid.update', $shahid->id) }}" class="row">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 col-6">
                        <label class="form-label">کد ملی</label>
                        <input type="text" name="national_code" class="form-control" value="{{ old('national_code', $shahid->national_code) }}" required>
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">نام</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $shahid->first_name) }}" required>
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">نام خانوادگی</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $shahid->last_name) }}" required>
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">نام پدر</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $shahid->father_name) }}">
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">تاریخ تولد</label>
                        <input type="text" name="birth_date" class="form-control" data-jdp value="{{ old('birth_date', $shahid->birth_date) }}">
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">تاریخ شهادت</label>
                        <input type="text" name="martyrdom_date" class="form-control" data-jdp value="{{ old('martyrdom_date', $shahid->martyrdom_date) }}">
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">مزار</label>
                        <input type="text" name="cemetery" class="form-control" value="{{ old('cemetery', $shahid->cemetery) }}">
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">استان تولد</label>
                        <select name="birth_province_id" id="provinceSelect" class="form-control">
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" {{ $shahid->birth_province_id == $province->id ? 'selected' : '' }}>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">شهر تولد</label>
                        <select name="birth_city_id" class="form-control" id="citySelect">
                            <option value="">در حال بارگذاری...</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label">بخش تولد</label>
                        <input type="text" name="birth_district" class="form-control" value="{{ old('birth_district', $shahid->birth_district) }}">

                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">مرکز</label>
                        <select name="center_city_id" class="form-control" id="centerCitySelect">
                            @foreach($center_cities as $city)
                                <option value="{{ $city->id }}" {{ $shahid->center_city_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- تصویر تکی (در صورت نیاز می‌تونه اضافه بشه) --}}
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
                    <div class="mb-3 col-12">
                        <label for="biography" class="form-label">زندگی‌نامه</label>
                        <textarea class="form-control" id="biography" name="biography" rows="6">{{ old('biography', $shahid->biography ?? '') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/jalalidatepicker.min.js') }}"></script>
    <script>
        jalaliDatepicker.startWatch();
        ClassicEditor
            .create(document.querySelector('#biography'), {
                language: 'fa',  // زبان فارسی (راست به چپ)
                height: 300,     // ارتفاع 600px (بیشتر از پیش‌فرض)
            })
            .catch(error => {
                console.error(error);
            });
        Dropzone.autoDiscover = false;

        const profileDropzone = new Dropzone("#image-dropzone", {
            url: "{{ route('upload.image') }}",
            maxFiles: 1,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            dictDefaultMessage: "فقط یک تصویر پروفایل انتخاب کنید",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                document.getElementById('profile_image').value = response.url;
            },
            init: function () {
                let dz = this;

                // اگر تصویر پروفایل قبلاً بارگذاری شده است، آن را به صورت پیش‌نمایش نمایش دهیم
                @if(isset($shahid) && $shahid->profile_image)
                const mockFile = {
                    name: "{{ basename($shahid->profile_image) }}",
                    size: 123456,
                    uploadedPath: "{{ $shahid->profile_image }}"
                };

                dz.emit("addedfile", mockFile);
                dz.emit("thumbnail", mockFile, "{{ asset( $shahid->profile_image) }}");
                dz.emit("complete", mockFile);

                // ذخیره URL تصویر پروفایل در hidden input
                document.getElementById('profile_image').value = "{{ $shahid->profile_image }}";
                @endif
            }
        });

        const existingGallery = @json($shahid->galleries);

        const galleryDropzone = new Dropzone("#gallery-dropzone", {
            url: "{{ route('gallery.upload') }}",
            acceptedFiles: "image/*",
            maxFilesize: 4,
            addRemoveLinks: true,
            dictDefaultMessage: "چند تصویر را بکشید یا انتخاب کنید",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },init: function () {
                let dz = this;
                const existingGallery = @json($galleries);

                existingGallery.forEach(function (image) {
                    let mockFile = {
                        name: image.image_path.split('/').pop(),
                        size: 123456,
                        uploadedPath: image.image_path
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, "{{ asset('storage') }}/" + image.image_path);
                    dz.emit("complete", mockFile);

                    // input hidden مربوط به این تصویر
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'gallery_paths[]';
                    input.value = image.image_path;
                    input.dataset.dzPath = image.image_path;
                    document.getElementById('gallery-hidden-inputs').appendChild(input);
                });
            },
            success: function (file, response) {
                file.uploadedPath = response.path;
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'gallery_paths[]';
                input.value = response.path;
                input.dataset.dzPath = response.path;
                document.getElementById('gallery-hidden-inputs').appendChild(input);
            },
            removedfile: function (file) {
                const path = file.uploadedPath;
                const inputs = document.querySelectorAll('input[name="gallery_paths[]"]');
                inputs.forEach(input => {
                    if (input.dataset.dzPath === path) input.remove();
                });

                if (existingGallery.find(img => img.image_path === path)) {
                    fetch("{{ url('gallery') }}/" + existingGallery.find(img => img.image_path === path).id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                }

                file.previewElement.remove();
            }
        });

        $(document).ready(function () {
            let provinceId = $('#provinceSelect').val();
            let selectedCityId = '{{ $shahid->birth_city_id }}';

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

            if (provinceId) {
                loadCities(provinceId, selectedCityId);
            }

            $('#provinceSelect').on('change', function () {
                loadCities($(this).val());
            });
        });
    </script>
@endsection
