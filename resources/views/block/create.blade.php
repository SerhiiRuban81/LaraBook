@extends('layouts.master')
@section('menu')
    @parent
@endsection
@section('content')
<div class="row">
<div class="badge badge-info py-2" style="display: inline-block; width: 100%">
    {{ $page }}
</div>
</div>
@if (count($errors)>0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session("message"))
<div class="alert alert-success">{{ session("message")}} </div>
@endif
{!! Form::model($block, ["action"=>"BlockController@store", "files"=>true, "class"=>"form"]) !!}
<div class="form-group my-3">
{!! Form::label("topicid", "Выберите раздел:", ["class"=>"col-2"]) !!}
{!! Form::select("topicid", $topics, "", ["class"=>"col-7"]) !!}
<a href="{{url('topic/create') }}" class="btn btn-sm btn-info col-2">Добавить новый раздел</a>
</div>
<div class="form-group">
    {!! Form::label("title", "Заголовок блока:", ["class"=>"col-2"]) !!}
    {!! Form::text("title", "", ["class"=>"col-9"]) !!}
</div>
<div class="form-group">
    {!! Form::label("content", "Содержание блока:", ["class"=>"col-2"]) !!}
    {!! Form::textarea("content", "", ["class"=>"col-9", "cols"=>"", "rows"=>""]) !!}
</div>
<div class="form-group">
    {!! Form::label("imagePath", "Выберите изображение:", ["class"=>"col-2"]) !!}
    {!! Form::file("imagePath", ["class"=>"col-9"]) !!}
</div>
<button type="submit" class="btn btn-success">Добавить блок</button>
{!! Form::close() !!}
@endsection
