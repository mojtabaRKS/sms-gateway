@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row">
            <div class="col-6">{{ __('entities.form.keys.agency_type') }}</div>
            <div class="col-6">{{ __("entities.form.agency_type.{$form->agency_type}") }}</div>
        </div>
        <hr>
        @foreach (collect($form->getAttributes())->except('agency_type')->toArray() as $key => $value)
            <div class="row">
                <div class="col-6">{{ \App\Models\Form::getTranslatedKey($key) }}</div>
                <div class="col-6">{{ \App\Models\Form::getTranslatedValue($value) }}</div>
            </div>
        @endforeach
    </div>

@endsection
