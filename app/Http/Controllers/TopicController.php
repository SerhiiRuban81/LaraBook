<?php

namespace App\Http\Controllers;

use App\Block;
use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        $page = "Главная";
        $id = 0;
        return view("topic.index", array("topics"=>$topics,
        "page"=>$page, "id"=>$id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topic = new Topic;
        return view("topic.create", array("topic"=>$topic, "page"=>"Добавление нового раздела"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            "required"=>"Поле :attribute является обязательным!",
            "unique"=>"Поле :attribute является уникальным"
        ];
        $this->validate($request,
        ["topicname" => "required|unique:topics,topicname|max:255"], $messages);
        $topic = new Topic;
        $topic->topicname = $request->topicname;
        //$topic->save();
        if(!$topic->save())
        {
            $err = $topic->getError();
            return redirect()->action("TopicController@create")->with("errors", $err)->withInput();
        }
        return redirect()->action("TopicController@create")->with("message", "Новый раздел '". $topic->topicname ."' добавлен. Id = ". $topic->id );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topics = Topic::all();
        $blocks = Block::where("topicid", "=", $id)->get();
        return view("topic.index", array("id"=>$id,
        "page"=>"Главная", "topics"=>$topics, "blocks"=>$blocks));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request){
        $search = $request->searchform;
        $search = "%". $search ."%";
        $topics = Topic::where("topicname", "like", $search)->get();
        return view("topic.index", array("topics"=>$topics, "id"=>0, "page"=>"Главная"));
    }
}
