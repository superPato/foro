@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>
                {{ $category->exists ? 'Post de ' . $category->name : 'Posts' }}
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <h4>Filtros</h4>
            {!! Menu::make(trans('menu.filters'), 'nav filters') !!}

            <h4>Categorías</h4>
            {!! Menu::make($categoryItems, 'nav categories') !!}
        </div>
        <div class="col-md-10">
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
        </div>
    </div>


@endsection