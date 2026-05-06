@extends('layouts.app')

@section('content')
    <div class="about-container">
        <h1>Панель управления</h1>
    </div>

    {{-- Удаление товара --}}
    <div class="container mt-5">
        <form method="post" action="{{ route('del') }}">
            @csrf
            <div class="mb-3">
                <label for="productSelect" class="form-label">Удаление товара</label>
                <select id="productSelect" class="form-select" name="id">
                    <option selected disabled>Выберите товар для удаления</option>
                    @foreach($yy as $y)
                        <option value="{{ $y->id }}">{{ $y->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Удалить</button>
        </form>
    </div>

    {{-- Добавление товара --}}
    <div class="container mt-5">
        <h2>Добавить фильм</h2>
        <form action="{{route('add_img')}}" method="post" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label for="name_product" class="form-label">Название</label>
                <input type="text" class="form-control" id="name_product" name="name_product" required>
            </div>
            <div class="col-12">
                <label for="price_product" class="form-label">Цена</label>
                <input type="text" class="form-control" id="price_product" name="price_product" required>
            </div>
            <div class="col-12">
                <label for="about_product" class="form-label">Описание</label>
                <textarea class="form-control" id="about_product" name="about_product" rows="3" required></textarea>
            </div>
            <div class="col-12">
                <label for="review_product" class="form-label">Рецензия</label>
                <textarea class="form-control" id="review_product" name="review_product" rows="5" placeholder="Напишите рецензию на фильм..."></textarea>
            </div>
            <div class="col-12">
                <label for="year_product" class="form-label">Год выпуска</label>
                <input type="number" class="form-control" id="year_product" name="year_product" placeholder="Например: 2020">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Выберите постер</label>
                <input class="form-control" type="file" id="image" accept="image/*" name="image" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
        @if(session('msg'))
            <div class="alert alert-success mt-3">{{ session('msg') }}</div>
        @endif
    </div>

    {{-- Редактирование товара --}}
    <div class="container mt-5 mb-5">
        <h2>Изменить последний добавленный фильм</h2>
        <form method="post" action="{{route('redact')}}">
            @csrf
            <div class="mb-3">
                @if($tt)
                    <input type="hidden" name="id" value="{{$tt->id}}">
                    <input type="text" class="form-control" id="name" placeholder="Новое название" required name="name" value="{{$tt->name}}">
                    <button type="submit" class="btn btn-primary mt-3">Обновить</button>
                @else
                    <p style="color: #e6b609;">Нет товаров для редактирования.</p>
                @endif
            </div>
        </form>
    </div>
@endsection