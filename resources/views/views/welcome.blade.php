@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="mb-5">
            <div class="py-5 text-center">
                <h2 style="font-size: 25px;">مجموعه فروشگاه های زنجیره ای توت فرنگی</h2>
                <p class="mt-4 under-logo-content">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و
                    متون بلکه روزنامه و مجله
                    در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود
                    ابزارهای کاربردی می باشد،
                    کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم
                    افزارها شناخت بیشتری را برای
                    طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان
                    امید داشت که تمام و دشواری
                    موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و
                    جوابگوی سوالات پیوسته اهل
                    دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                </p>
            </div>

            <div class="flash info" style="border-radius: 4px;">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if (Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}" role="alert">
                            <a id="info-close" href="#" class="close" style="color: black;margin:0 10px"
                                data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('alert-' . $msg) }}
                        </p>
                    @endif
                @endforeach

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="row g-5 justify-content-md-center position-relative">
                <div class="col-md-7 col-lg-8">
                    <img class="logo-backg" style="" src="{{ asset('images/Logo.png') }}">

                    <h4 class="mb-3">نوع نمایندگی انتخابی شما</h4>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <select id="agency_type_select" class="form-select" name="agency_type_select"
                                required="required">
                                <option>لطفا انتخاب کنید</option>
                                <option value="online">اخذ نمایندگی به صورت آنلاین شاپ بدون سرمایه</option>
                                <option value="offline">اخذ نمایندگی بصورت مغازه حداقل 8 متری و 200 میلیون سرمایه اولیه
                                </option>
                            </select>
                        </div>
                    </div>

                    <form class="needs-validation" style="display:none;" id="online-shop-tag"
                        action="{{ route('forms.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="agency_type" id="agency_type_hidden_input" value="online">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">نام</label>
                                <input type="text" class="form-control" name="first_name" id="firstName" placeholder="نام"
                                    value="">
                            </div>
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">نام خانوادگی</label>
                                <input type="text" class="form-control" id="lastName" name="last_name"
                                    placeholder="نام خانوادگی" value="">
                            </div>
                            <div class="col-sm-6">
                                <label for="mobile" class="form-label">شماره همراه</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="شماره همراه" value="">
                            </div>
                            <div class="col-sm-6">
                                <label for="age" class="form-label">سن</label>
                                <input type="text" class="form-control" id="age" name="age" placeholder="سن" value="">
                            </div>
                            <div class="col-sm-6">
                                <label for="city" class="form-label">شهر محل سکونت</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="شهر مورد تقاضا جهت نمایندگی" value="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">میزان آشنایی با کسب و کار در فضای مجازی</label>
                                <select class="form-select" name="it_know">
                                    <option value="">انتخاب کنید</option>
                                    <option value="low">کم</option>
                                    <option value="medium">متوسط</option>
                                    <option value="high">خوب</option>
                                </select>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">ثبت</button>
                    </form>

                    <form class="needs-validation" style="display:none;" id="offline-shop-tag"
                        action="{{ route('forms.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="agency_type" id="agency_type_hidden_input" value="offline">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">نام</label>
                                <input type="text" class="form-control" name="first_name" id="firstName" placeholder="نام"
                                    value="">
                            </div>
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">نام خانوادگی</label>
                                <input type="text" class="form-control" id="lastName" name="last_name"
                                    placeholder="نام خانوادگی" value="">
                            </div>
                            <div class="col-sm-6">
                                <label for="mobile" class="form-label">شماره همراه</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="شماره همراه" value="">
                            </div>
                            <div class="col-sm-6">
                                <label for="age" class="form-label">سن</label>
                                <input type="text" class="form-control" id="age" name="age" placeholder="سن" value="">
                            </div>
                            <div class="col-12">
                                <div class="col-sm-6">
                                    <label for="city" class="form-label">شهر مورد تقاضا جهت نمایندگی</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="شهر مورد تقاضا جهت نمایندگی" value="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input name="has_shop" type="radio" value="with_shop" class="form-check-input" checked>
                                    <label class="form-check-label" for="credit">هم اکنون مغازه دارم</label>
                                </div>

                                <div class="form-check">
                                    <input name="has_shop" type="radio" value="planned_to_buy_shop"
                                        class="form-check-input">
                                    <label class="form-check-label" for="credit">تصمیم دارم مغازه تهیه کنم</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input name="is_owner" type="radio" value="is_owner" class="form-check-input" checked>
                                    <label class="form-check-label" for="credit">مالک هستم</label>
                                </div>

                                <div class="form-check">
                                    <input name="is_owner" type="radio" value="has_rented" class="form-check-input">
                                    <label class="form-check-label">مستاجر هستم</label>
                                </div>
                            </div>
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label class="form-label">متراژ مغازه مدنظر شما چقدر است؟</label>
                                    <input type="text" name="area" class="form-control"
                                        placeholder="متراژ مغازه مدنظر شما چقدر است ؟">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">میزان تحصیلات</label>
                                    <select class="form-select" name="degree">
                                        <option value="">انتخاب کنید</option>
                                        <option value="under_diploma">زیر دیپلم</option>
                                        <option value="diploma">دیپلم</option>
                                        <option value="associate">کاردانی</option>
                                        <option value="bachelor">کارشناسی</option>
                                        <option value="master">کارشناسی ارشد</option>
                                        <option value="phd">دکترا</option>
                                    </select>
                                </div>

                            </div>
                            <hr class="my-4">
                            <button class="w-100 btn btn-primary btn-lg" type="submit">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>


    <script>
        $('#agency_type_select').on('change', function() {
            let id = this.value + "-shop-tag"
            $("#online-shop-tag").slideUp()
            $("#offline-shop-tag").slideUp()
            $("#" + id).slideDown()
        });
    </script>
@endsection

@push('scripts')

@endpush
