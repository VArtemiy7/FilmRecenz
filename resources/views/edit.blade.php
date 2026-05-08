@extends('layouts.app')

@section('content')
<div class="about-container">
    <h1>Редактирование фильма</h1>
</div>

<div class="container mt-5">
    <form action="{{ route('update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Название</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Оценка (1-10)</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" min="1" max="10" required>
            </div>
            <div class="col-12">
                <label class="form-label">Год выпуска</label>
                <input type="number" name="year" class="form-control" value="{{ $product->year }}">
            </div>
            <div class="col-12">
                <label class="form-label">Описание</label>
                <textarea name="about" class="form-control" rows="4" required>{{ $product->about }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Рецензия</label>
                <textarea name="review" class="form-control" rows="6">{{ $product->review }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Текущий постер</label>
                <br>
                <img src="{{ asset('images/' . $product->img) }}" style="max-height: 200px; border-radius: 8px;">
            </div>
            <div class="col-12">
                <label class="form-label">Новый постер</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-save">Сохранить изменения</button>
                <a href="{{ route('panel') }}" class="btn btn-cancel">Отмена</a>
            </div>
        </div>
    </form>
</div>
@endsection