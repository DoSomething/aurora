@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Edit User', 'subtitle' => 'Update info for ' . ((isset($user['first_name']) ? $user['first_name'] : "") . " " . (isset($user['last_name']) ? $user['last_name'] : ""))])

  @include('users.partials._form')
@stop
