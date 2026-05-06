@extends('layouts.app')

@section('content')
    <div class="about-container">
        <h1 class="fade-out">Панель управления</h1>
    </div>

    <div class="container mt-5">
        <form method="post" action="{{ route('del') }}">
            @csrf
            <div class="mb-3">
                <label for="productSelect" class="form-label">Удаление товара</label>
                <select id="productSelect" class="form-select" name="id">
                    <option selected>Откройте меню</option>
                        @foreach($yy as $y)
                            <option value="{{ $y->id }}">{{ $y->name }}</option>
                        @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Удалить</button>
        </form>
    </div>

    <div class="container mt-5">
        <br>
        <h2>Добавить товар</h2>
        <form action="{{route('img')}}" method="post" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label for="name_product" class="form-label">Название</label>
                <input type="text" class="form-control" id="name_product" name="name_product" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Выберите фото для товара</label>
                <input class="form-control" type="file" id="image" accept="image/*" name="image" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
        <div style="color: green;font-weight: bold; border-radius: 5px; padding: 2px; border-color: #5cac5c">{{ session('msg')}}</div>
    </div>


    <div class="container mt-5">
        <form method="post" action="{{route('add')}}">
            @csrf
            <div class="mb-3">
                <label for="exampleSelect" class="form-label">Добавление товара</label>
                <input type="text" class="form-control" id="name" placeholder="Введите имя" required name="name">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

    <div class="container mt-5">
        <form method="post" action="{{route('redact')}}">
            @csrf
            <div class="mb-3">
                <label for="exampleSelect" class="form-label">Изменение товара</label>
                <input type="hidden" name="id" value="{{$tt[0]->id}}">
                <input type="text" class="form-control" id="name" placeholder="Введите имя" required name="name" value="{{$tt[0]->name}}">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
@endsection
