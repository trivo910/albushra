@extends('admin.layouts.app')

@section('title', 'Edit Page')

@section('content')
    <form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data">
        @include('admin.pages._form')
    </form>
@endsection
