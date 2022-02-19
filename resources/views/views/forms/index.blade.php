@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text">تعداد بازدید کلی : {{ $viewCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text">تعداد ثبت فرم کلی : {{ $allCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text">تعداد ثبت فرم نمایندگی آنلاین : {{ $onlineCount }}</p>
                </div>
            </div>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">تعداد ثبت فرم نمایندگی حضوری : {{ $offlineCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <form action="{{ route('forms.index') }}">
        <div class="row">
            <div class="col-3">
                <input type="text" name="start_at" placeholder="از" class="form-control">
            </div>
            <div class="col-3">
                <input type="text" name="end_at" placeholder="تا" class="form-control">
            </div>
            <div class="col-3">
                <select class="form-select" name="agency_type_select" id="">
                    <option value="">انتخاب نوع نمایندگی</option>
                    <option value="online">نمایندگی آنلاین</option>
                    <option value="offline">نمایندگی حضوری</option>
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-success">جستجو</button>
            </div>
        </div>
    </form>

    <hr>

    <h2>لیست درخواست ها</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نوع</th>
                    <th scope="col">نام و نام خانوادگی</th>
                    <th scope="col">شماره همراه</th>
                    <th scope="col">سن</th>
                    <th scope="col">شهر</th>
                    <th scope="col">مشاهده جزییات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ __("entities.form.agency_type.{$form->agency_type}") }}</td>
                        <td>{{ $form->full_name }}</td>
                        <td>{{ $form->mobile }}</td>
                        <td>{{ $form->age }}</td>
                        <td>{{ $form->city }}</td>
                        <td><a href="{{ route('forms.show', ['form' => $form->_id]) }}">مشاهده</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{ $forms->links() }}
    </div>

@endsection
