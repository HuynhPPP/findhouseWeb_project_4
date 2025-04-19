@extends('front.HomePage')
@section('home')

@section('title')
Kênh thông tin phòng trọ | nhà ở
@endsection

@include('front.home.header_search')

@include('front.home.categories')

@include('front.home.featured_properties')

@include('front.home.popular_places')

@include('front.home.recently_properties')

@endsection