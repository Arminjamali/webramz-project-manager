<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ورود</title>

    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/boxicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-xl px-4 is-rtl">
                <div class="row justify-content-center">
                    <div class="col-lg-4">

                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header justify-content-center"><h3 class="fw-light my-2">ورود به حساب کاربری</h3></div>
                            <div class="card-body">

                                <form id="formAuthentication" action="{{ route('login') }}" method="POST">
                                    @csrf

                                    <!-- نمایش ارورها -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            {{ $errors->first() }}
                                        </div>
                                    @endif

                                    <!-- ایمیل یا نام کاربری -->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">ایمیل</label>
                                        <input class="form-control" name="email" id="email" type="email" placeholder="ایمیل خود را وارد کنید" required>
                                    </div>

                                    <!-- رمز عبور -->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="password">رمز عبور</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input type="password" name="password" id="password" class="form-control text-start" dir="ltr" required>
                                            <span class="input-group-text cursor-pointer"><i id="togglePassword" class="bx bx-hide"></i></span>
                                        </div>
                                    </div>

                                    <!-- دکمه ورود -->
                                    <button type="submit" class="btn btn-primary btn-block w-100">ورود</button>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small">حساب ایجاد نکردید؟ <a href="../register/basic.html">ایجاد کنید</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="footer-admin mt-auto is-rtl">
            <div class="container-xl px-4">
                <div class="row">
                    <div class="col-md-6 small">طراحی شده با ❤️ ارائه شده در وب‌سایت راست‌چین</div>
                    <div class="col-md-6 text-md-end small">
                        <a href="#!">قوانین و مقررات</a>
                        ·
                        <a href="#!">لایسنس ها</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>

</body>
</html>
