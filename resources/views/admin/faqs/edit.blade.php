@extends('admin.layouts.app')

@section('title', 'Edit FAQ')

@section('content')
    <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
        @include('admin.faqs._form')
    </form>
@endsection
