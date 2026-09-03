@extends('admin.layouts.app')

@section('title', 'New Blog Post')

@section('content')
    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
        @include('admin.blogs._form')
    </form>
@endsection
