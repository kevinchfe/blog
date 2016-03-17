@extends('app')

@section('content')
    <h1>Edit:{!! $article->title !!}</h1>

    {!! Form::model($article,['url'=>'articles/'.$article->id,'method'=>'patch']) !!}

    @include('articles._form',['submitButton'=>'Edit Article'])
    {!! Form::close() !!}

    @include('errors.list')
@stop