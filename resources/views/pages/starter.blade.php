@extends('components.layout')
@section('title')
    Starter Page || صفحة فارغة
@endsection
@section('body')
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('logout', app()->getLocale()) }}">
    @csrf
    <button type="submit">{{ __('Logout') }}</button>
</form>
    </div>
@endsection
