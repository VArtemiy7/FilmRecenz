@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($myproducts as $product)
    <div class="movie-detail-card">
        <div class="movie-poster-wrapper">
            <img src="{{asset('images/' .$product->img)}}" class="movie-poster-img" alt="{{$product->name}}">
        </div>
        
        <div class="movie-info-wrapper">
            <h1 class="movie-title">{{$product->name}}</h1>
            
            <div class="movie-meta">
                @if(isset($product->year))
                <span class="movie-year">{{$product->year}}</span>
                <span class="meta-divider"> </span>
                @endif
                <span class="movie-price">{{$product->price}}/10</span>
            </div>
            
            <div class="movie-description-text">
                {{$product->about}}
            </div>
            
            <a href="{{ route('review', $product->id) }}" class="btn btn-primary btn-review">
                Смотреть рецензию к фильму
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection