@extends('layouts.app')

@section('content')
    <div class="about-container">
        <h1 class="fade-out">FilmRecenz</h1>
        <span>Добро пожаловать на FilmRecenz! Мы — онлайн-кинотека, где собраны лучшие фильмы всех времён. От советской классики до современных блокбастеров — у нас вы найдёте кино на любой вкус.</span>
    </div>

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3"></button>
        </div>
        
        
        <div class="carousel-inner">
            @foreach($sliderproducts as $product)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="5000">
                <a href="{{ route('product', $product->id) }}">
                    <img src="{{ asset('images/' . $product->img) }}" class="d-block w-100" alt="{{ $product->name }}">
                </a>
                <div class="carousel-caption">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->year }} - {{ $product->price }}/10</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
@endsection