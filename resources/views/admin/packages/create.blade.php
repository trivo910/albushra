@extends('admin.layouts.app')

@section('title', 'New Package')

@section('content')
    <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data">
        @include('admin.packages._form')
    </form>
@endsection
