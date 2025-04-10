@extends('layouts.shop')

@section('title', 'Home - Online Shop')

@section('content')
@include('components.shop.hero')
@include('components.shop.brand-statement')
@include('components.shop.why-choose')
@include('components.shop.categories')
@include('components.shop.products')
@include('components.shop.testimonials')
@endsection

@push('styles')
<style>
    /* Custom colors */
    .bg-navy-900 { background-color: #0f172a; }
    .text-navy-900 { color: #0f172a; }
    .bg-mustard-400 { background-color: #facc15; }
    .text-mustard-400 { color: #facc15; }
    .bg-navy-900\/70 { background-color: rgba(15, 23, 42, 0.7); }
    .bg-navy-900\/80 { background-color: rgba(15, 23, 42, 0.8); }
</style>
@endpush 