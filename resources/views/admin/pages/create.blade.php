@extends('admin.layouts.app')

@section('title', 'New Page')

@section('content')
    <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">
        @include('admin.pages._form')
    </form>
@endsection
