@extends('layouts.site')

@section('header')
	{!! $header ? $header : '' !!}
@endsection

@section('navigation')
	{!! $navigation ? $navigation : '' !!}
@endsection

@section('content')
	{!!  $content ? $content : '' !!}
@endsection

@section('sidebar')
	{!!  $sidebar ? $sidebar : '' !!}
@endsection

@section('footer')
	{!! $footer ? $footer : '' !!}
@endsection