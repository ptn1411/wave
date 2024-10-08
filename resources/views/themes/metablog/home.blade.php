@extends('theme::layouts.app')

@section('content')
@include('theme::partials.home-banner-start')
@include('theme::partials.home-category')
@include('theme::partials.home-post-trending')
@include('theme::partials.home-post-pick')
@include('theme::partials.home-sidebar')
@endsection