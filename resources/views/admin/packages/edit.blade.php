@extends('admin.layouts.app')

@section('title', 'Edit Package')

@section('content')
    <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data">
        @include('admin.packages._form')
    </form>
@endsection
