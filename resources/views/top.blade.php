@extends('layouts.app')

@section('content')
    <div class="about-container">
        <h1>Топ 5 фильмов</h1>
        <span>5 Лучших фильмов по оценке зрителей</span>
    </div>
    
    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 20px; max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        @foreach($topProducts as $index => $product)
        <div style="width: 200px;">
            <div class="card h-100">
                <div class="top-badge">#{{ $index + 1 }}</div>
                <img src="{{ asset('images/'.$product->img) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text-price">{{ $product->price }}/10</p>
                    <a href="{{ route('product', $product->id) }}"><button class="btn btn-primary" type="button">Смотреть</button></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection