@extends('admin.layouts.app')

@section('title', 'Edit Page')

@section('content')
    <form method="POST" action="{{ route('admin.pages.update', $page) }}">
        @include('admin.pages._form')
    </form>
@endsection
