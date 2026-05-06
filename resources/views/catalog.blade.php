@extends('layouts.app')

@section('content')
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        По году выпуска
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('catalog') }}">По умолчанию</a></li>
        <li><a class="dropdown-item" href="{{ route('catalog', ['sort_year' => 'new']) }}">Сначала новые</a></li>
        <li><a class="dropdown-item" href="{{ route('catalog', ['sort_year' => 'old']) }}">Сначала старые</a></li>
    </ul>
    
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        По оценке
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('catalog', ['sort_rating' => 'high']) }}">Сначала высокие</a></li>
        <li><a class="dropdown-item" href="{{ route('catalog', ['sort_rating' => 'low']) }}">Сначала низкие</a></li>
    </ul>
    <a href="{{ route('catalog') }}" class="btn btn-secondary">Сбросить фильтры</a>
</div>
    <div class="container-fluid px-4">
        <div class="row g-3">
            @foreach($myproducts as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card h-100">
                    <img src="{{asset('images/'.$product->img)}}" class="card-img-top" alt="{{$product->name}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text-short_about">{{$product->about}}</p>
                        <p class="card-text-price">{{$product->price}}/10</p>
                        <a href="{{ route('product', $product->id)}}"><button class="btn btn-primary" type="button">К странице фильма</button></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
