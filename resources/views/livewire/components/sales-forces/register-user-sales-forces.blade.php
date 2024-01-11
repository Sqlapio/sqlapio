@extends('layouts.app')
@section('title', 'Registro de Usuario')

@push('scripts')
   
@endpush
@section('content')
    <div>
       <x-input-form-sale-component :hash="$hash" :user="$user"/>
    </div>
@endsection
