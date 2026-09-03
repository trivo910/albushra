@extends('admin.layouts.app')

@section('title', 'New FAQ')

@section('content')
    <form method="POST" action="{{ route('admin.faqs.store') }}">
        @include('admin.faqs._form')
    </form>
@endsection
