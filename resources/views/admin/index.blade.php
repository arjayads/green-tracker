@extends('layouts.master')

@section('title', 'Admin')

@section('css')
@stop

@section('content')
    <div>
        <div>
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        @include('includes.nav-admin')
                        <h2>Welcome to admin page</h2>
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop


@section('javascript')
@stop