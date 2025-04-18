@extends('layouts.master')

@section('title') Dashboard @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Welcome to the Dashboard</h2>
    <p>You are logged in successfully!</p>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
