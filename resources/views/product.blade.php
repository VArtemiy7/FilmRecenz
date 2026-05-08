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
    
    <div class="comments-section mt-5">
        <h3>Отзывы пользователей о фильме</h3>
        
        @auth
            @php
                $userComment = $comments->where('user_id', auth()->id())->first();
            @endphp
            
            @if(!$userComment)
            <form action="{{ route('add_comment') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <textarea name="comment_text" class="form-control" rows="3" placeholder="Поделитесь впечатлениями..." required minlength="3" maxlength="1000"></textarea>
                <button type="submit" class="btn btn-primary mt-2">Отправить отзыв</button>
            </form>
            @endif
        @else
            <p><a href="{{ route('login') }}">Войдите</a>, чтобы оставить отзыв.</p>
        @endauth
        
        @if(session('comment_msg'))
            <div class="alert alert-success">{{ session('comment_msg') }}</div>
        @endif
        
        @foreach($comments as $comment)
        <div class="comment-card">
            <strong>{{ $comment->user_name }}</strong>
            <small>{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y H:i') }}</small>
            
            @auth
                @if(auth()->id() == $comment->user_id)
                <div style="float: right;">
                    <button onclick="toggleEdit({{ $comment->id }})" class="btn btn-sm" style="background: var(--accent); color: #fff;">Редактировать отзыв</button>
                    <form action="{{ route('delete_comment') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <button type="submit" class="btn btn-sm" style="background: #dc3545; color: #fff;">Удалить</button>
                    </form>
                </div>
                @endif
            @endauth
            
            <p class="comment-text" id="comment-text-{{ $comment->id }}">{{ $comment->comment_text }}</p>
            
            @auth
                @if(auth()->id() == $comment->user_id)
                <form action="{{ route('edit_comment') }}" method="POST" id="edit-form-{{ $comment->id }}" style="display: none;">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <textarea name="comment_text" class="form-control" rows="3" required minlength="3" maxlength="1000">{{ $comment->comment_text }}</textarea>
                    <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
                    <button type="button" onclick="toggleEdit({{ $comment->id }})" class="btn btn-secondary mt-2">Отмена</button>
                </form>
                @endif
            @endauth
        </div>
        @endforeach
    </div>

    <script>
    function toggleEdit(id) {
        var text = document.getElementById('comment-text-' + id);
        var form = document.getElementById('edit-form-' + id);
        
        if (text.style.display === 'none') {
            text.style.display = 'block';
            form.style.display = 'none';
        } else {
            text.style.display = 'none';
            form.style.display = 'block';
        }
    }
    </script>
    @endforeach
</div>
@endsection