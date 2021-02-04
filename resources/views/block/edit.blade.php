@extends('layouts.master')
@section('menu')
@parent
@endsection
@section('content')
    <div class="row">
        <div class="badge badge-info py-2" style="display: inline-block; width: 100%">{{ $page }}</div>
    </div>
    @if (count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- @if (session("message"))
    <div class="alert alert-success"> {{ session("message") }}</div>
    @endif --}}
    {!! Form::model($block, array("route"=>array("block.update", $block->id), "files"=>true, "method"=>"PUT", "class"=>"form")) !!}
    <div class="form-group">
        {!! Form::label("topicid", "Выберите раздел:", ["class"=>"col-2"]) !!}
        {!! Form::select("topicid", $topics, $block->topicid, array("class"=>"form-control col-7")) !!}
        <a href="{{ url("topic/create") }}" class="btn btn-sm btn-info col-2">Добавить новый раздел</a>
    </div>
    <div class="form-group">
        {!! Form::label("title", "Заголовок блока:", array("class"=>"col-2")) !!}
        {!! Form::text("title", $block->title, array("class"=>"col-9 form-control")) !!}
    </div>
    <div class="form-group">
        {!! Form::label("content", "Содержание блока:", array("class"=>"col-2")) !!}
        {!! Form::textarea("content", $block->content, array("class"=>"col-9 form-control")) !!}
    </div>
    <div class="form-group">
        {!! Form::label("imagePath", "Выберите изображение:", array("class"=>"col-2")) !!}
        {!! Form::file("imagePath", array("class"=>"form-control col-9", "accept"=>"image/*")) !!}
    </div>
    {!! Form::submit("Сохранить", array("class"=>"btn btn-primary")) !!}
    {!! Form::close() !!}

@endsection
