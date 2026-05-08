@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="profile-name">{{ $user->name }} {{ $user->surname }}</h2>
                <p class="profile-email">{{ $user->email }}</p>
            </div>
        </div>
        
        <div class="profile-body">
            <h4>Редактировать профиль</h4>
            <form action="{{ route('profile_update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Имя</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Фамилия</label>
                    <input type="text" name="surname" class="form-control" value="{{ $user->surname }}">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
            
            @if(session('profile_msg'))
                <div class="alert alert-success mt-3">{{ session('profile_msg') }}</div>
            @endif
        </div>
    </div>
    
    <div class="profile-comments mt-4">
        <h3>Мои отзывы</h3>
        @if(count($comments) > 0)
            @foreach($comments as $comment)
            <div class="comment-card">
                <a href="{{ route('product', $comment->product_id) }}">
                    <strong>{{ $comment->product_name }}</strong>
                </a>
                <small>{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y H:i') }}</small>
                
                <form action="{{ route('delete_comment') }}" method="POST" style="float: right;">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <button type="submit" class="btn btn-sm" style="background: #dc3545; color: #fff;">Удалить отзыв</button>
                </form>
                
                <button onclick="toggleEdit({{ $comment->id }})" class="btn btn-sm" style="background: var(--accent); color: #fff; float: right; margin-right: 5px;">Редактировать отзыв</button>
                
                <p class="comment-text" id="comment-text-{{ $comment->id }}">{{ $comment->comment_text }}</p>
                
                <form action="{{ route('edit_comment') }}" method="POST" id="edit-form-{{ $comment->id }}" style="display: none;">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <textarea name="comment_text" class="form-control" rows="3" required>{{ $comment->comment_text }}</textarea>
                    <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
                    <button type="button" onclick="toggleEdit({{ $comment->id }})" class="btn btn-secondary mt-2">Отмена</button>
                </form>
            </div>
            @endforeach
        @else
            <p>У вас пока нет отзывов.</p>
        @endif
    </div>
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
@endsection