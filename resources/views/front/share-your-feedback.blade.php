@extends('layouts.app')

@php
    $seo = getSeo('share-your-feedback');
@endphp

@section('meta_title', $seo->meta_title ?? 'Share Your Feedback')

@section('meta_description', $seo->meta_description ?? '')

@section('other_scripts')

    {!! $seo->other_scripts ?? '' !!}

@endsection

@section('content')

<div class="min-h-[300px]"></div>

@endsection