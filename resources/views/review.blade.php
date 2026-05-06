@extends('layouts.app')

@section('content')
<div class="container">
    <div class="review-page-card">
        {{-- Постер --}}
        <div class="review-page-poster">
            <img src="{{ asset('images/' . $product->img) }}" alt="{{ $product->name }}">
        </div>
        
        {{-- Информация --}}
        <div class="review-page-info">
            <h1 class="review-page-title">{{ $product->name }}</h1>
            
            <div class="review-page-meta">
                <span class="review-page-year">{{ $product->year }}</span>
                <span class="meta-divider">•</span>
                <span class="review-page-price">{{ $product->price }}/10</span>
            </div>
            
            <div class="review-page-about">
                <h3>О фильме</h3>
                <p>{{ $product->about }}</p>
            </div>
            
            <div class="review-page-review">
                <h3>Рецензия</h3>
                @if($product->review)
                <div class="review-page-text">
                    {{ $product->review }}
                </div>
                @else
                <div class="review-page-empty">
                    <p>Рецензия пока не добавлена.</p>
                </div>
                @endif
            </div>
            
            <div class="review-page-actions">
                <a href="{{ route('product', $product->id) }}" class="btn btn-secondary">
                    ← Назад к фильму
                </a>
                <a href="{{ route('catalog') }}" class="btn btn-primary">
                    В каталог
                </a>
            </div>
        </div>
    </div>
</div>
@endsection