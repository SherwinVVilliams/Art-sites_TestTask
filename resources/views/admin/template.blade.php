@extends('layouts.admin')

@section('header')
	{!! $header ? $header : '' !!}
@endsection

@section('content')
	{!! $content ? $content : '' !!}
@endsection

@section('sidebar')
	{!! $sidebar ? $sidebar : '' !!}
@endsection

@section('footer')
	{!! $footer ? $footer : '' !!}
@endsection