@extends('layouts.master')
@section('menu')
    @parent
@endsection
@section('content')
<div class="row">
    <div class="badge badge-info py-2" style="display: inline-block; width: 100%">{{$page}}</div>
    </div>
    @if (count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session("message"))
    <div class="alert alert-success">
        <div> {{ session("message") }} </div>
    </div>
    @endif
    <div class="row offset-1">
        {!! Form::model($topic, array("action"=>"TopicController@store")) !!}
        <div class="form-group">
            {!! Form::label("topicname", "Название раздела") !!}
            {!! Form::text("topicname", "", array("class"=>"form-control")) !!}
        </div>
        {!! Form::submit("Добавить", array("class"=>"btn btn-success")) !!}
        {!! Form::close() !!}
    </div>
@endsection
