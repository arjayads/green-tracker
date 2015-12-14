@extends('layouts.master')

@section('title', 'Create Employee')

@section('css')
    <link href="{{asset('css/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/datapicker/angular-datapicker.css')}}" rel="stylesheet">
    <link href="{{asset('css/autocomplete/angucomplete-alt.css')}}" rel="stylesheet">
@stop

@section('content')

<div ng-app="employee">
    <div ng-controller="createCtrl">
        <div id="primary" class="content-area mg-t-10 mg-b-10">
            <main id="main" class="site-main" role="main">
                <div class="container">
                    <a href="/emp" class="btn btn-primary">Back to list</a>
                    <h2>Create employee record</h2>
                    <hr/>
                    @include('emp.form')
                </div>
            </main>
        </div>
    </div>
</div>
@stop

@section('javascript')
    <script src="{{asset('js/datepicker/datepicker.js')}}"></script>
    <script src="{{asset('js/autocomplete/angucomplete-alt.min.js')}}"></script>
    <script src="{{asset('js/app/directives/form-error.js')}}"></script>
    <script src="{{asset('js/app/modules/emp-create.js')}}"></script>

    <script>
        $(function () {
            $('.datepicker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "mm/dd/yyyy"
            });
        })
    </script>
@stop