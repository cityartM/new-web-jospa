@extends('frontend::layouts.master')

@section('content')
    <x-frontend.services-section :services="$services" :categories="$categories" />
    <x-frontend.gift-section />
    <x-frontend.premium-packages-section :packages="$packages" />
    <x-frontend.learn-about-section />
    <x-frontend.goals-vision-section />
@endsection
