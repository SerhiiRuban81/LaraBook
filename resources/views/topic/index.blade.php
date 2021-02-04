@extends('layouts.master')
@section('menu')
    @parent
@endsection
@section('content')
<div class="row">
<div class="col-3 text-left">
    {!! Form::open(array("action"=>"TopicController@search", "class"=>"form-inline")) !!}
    {!! Form::text("searchform", "",  array("placeholder"=>"Введите раздел...", "class"=>"form-control")) !!}
    {!! Form::submit("Найти", array("class"=>"btn btn-sm btn-secondary")) !!}
    {!! Form::close() !!}
    <ul style="list-style-type: none">
    @foreach ($topics as $item)
    <li><a href="{{ url("topic/". $item->id)}}" class="badge alert-light">{{$item->topicname}}</a></li>
    @endforeach
</ul>
</div>
<div class="col-9 float-right">
    @if ($id!=0)
    @foreach ($blocks as $block)

    <div class="row">
        <div>
        <h2>{{$block->title}}</h2>
        @if ($block->imagePath!="")
        <a href="{{ url($block->imagePath)}}" target="_blank" style="float: left; margin-right: 20px;" >
            <img src="{{ asset($block->imagePath) }}" alt="" class="img-fluid" style="height: 150px"/>
        </a>
        @endif
        {{-- <pre style='white-space: wrap'>{{$block->content}}</pre> --}}
        <div>{{$block->content}}</div>
        <div class="float-right">
        {!! Form::open(array("route"=>array("block.destroy", $block->id))) !!}
        {!! Form::hidden("_method", "DELETE") !!}
        <button type="submit" class="btn btn-sm btn-danger">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
          </svg> --}}
          <img src="{{ asset("img/trash.svg") }}" alt="delete"/>
        </button>
        {!! Form::close() !!}
    </div>
    <div class="float-right">
    {{-- {!! Form::open(array("route"=>array("block.edit", $block->id))) !!}
    {!! Form::hidden("_method", "PUT") !!} --}}

        <a class="btn btn-sm btn-info" href={{url("block/". $block->id . "/edit")}}> <img src="{{ asset("img/pencil.svg") }}" alt="edit"/></a>

        {{-- </button> --}}
        {{-- {!! Form::close() !!} --}}
    </div>

    </div>
</div>
    @endforeach
    @endif
</div>
</div>
@endsection
