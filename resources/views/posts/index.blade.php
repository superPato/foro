@extends('layouts.app')

@section('content')
    <h1>
        {{ $category->exists ? 'Post de ' . $category->name : 'Posts' }}
        Posts</h1>

    <ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ $post->url }}">
                {{ $post->title }}
            </a>
        </li>
    @endforeach
    </ul>

    {{ $posts->render() }}

    {!! Menu::make($categoryItems, 'nav categories') !!}

@endsection