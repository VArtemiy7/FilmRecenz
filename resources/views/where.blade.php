@extends('layouts.app')

@section('content')
    <figure class="text-center">
        <blockquote class="blockquote">
            <h1>А где нас найти?</h1>
        </blockquote>
        <figcaption class="blockquote-footer">
            Можете найти нас <cite title="Source Title">На карте</cite>
        </figcaption>
    </figure>
    
    <div class="map-bootstrap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18906.129712753736!2d6.722624160288201!3d60.12672284414915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x463e997b1b6fc09d%3A0x6ee05405ec78a692!2sJ%C4%99zyk%20trola!5e0!3m2!1spl!2spl!4v1672239918130!5m2!1spl!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    
    <figure class="text-center mt-4">
        <blockquote class="blockquote">
            <h2>Также наши контакты</h2>
        </blockquote>
    </figure>
    
    <div style="max-width: 500px; margin: 20px auto 40px; padding: 25px 30px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; text-align: center;">
        <h5 style="margin-bottom: 10px;">Телефон: +7-999-999-99-99</h5>
        <h5 style="margin-bottom: 10px;">Почта: example@gmail.com</h5>
        <h5 style="margin-bottom: 0;">Адрес: Trolltunga, 5750 Odda, Norwegia</h5>
    </div>
@endsection