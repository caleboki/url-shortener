@extends('layouts.app')

@section('styles')
@endsection

@section('content')

    <div class="wrapper_url_shortener">
        <url-shortener :user="{{Auth::user()->id ?? null}}"></url-shortener>
    </div>
@endsection
