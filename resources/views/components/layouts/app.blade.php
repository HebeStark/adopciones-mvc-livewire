@extends('layouts.app')

@section('title', $title ?? 'Portal de Adopciones')

@section('content')
    {{ $slot }}
@endsection
