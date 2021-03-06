@extends('app')

@section('content')

    <h1>write a new article</h1>
    <hr>

    {!! Form::model($article = new App\Article,['url'=>'articles']) !!}

    @include('articles._form',['submitButton'=>'Add Article'])
    {!! Form::close() !!}

    @include('errors.list')
@stop