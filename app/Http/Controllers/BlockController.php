<?php

namespace App\Http\Controllers;

use App\Block;
use App\Topic;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $block = new Block;
        $topics = Topic::pluck("topicname", "id");
        $page = "Добавить новый блок";
        return view("block.create", array("block"=>$block, "page"=>$page, "topics"=>$topics));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $block = new Block;
        $fname = $request->file("imagePath");
        if($fname!=null){
            $originalName = $request->file("imagePath")->getClientOriginalName();
            $request->file("imagePath")->move(public_path()."/images", $originalName);
            $block->imagePath = "/images/". $originalName;
        }
        else
        {
            $block->imagePath = "";
        }
        $block->topicid = $request->topicid;
        $block->title = $request->title;
        $block->content = $request->content;
        if(!$block->save())
        {
            $errors = $block->getErrors();
            return redirect()->action("BlockController@create")->with("errors", $errors)
            ->withInput();
        }
        return redirect()->action("BlockController@create")->with("message", "Блок '". $block->title . "' успешно добавлен! Id = " . $block->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $block = Block::find($id);
        $topics = Topic::pluck("topicname", "id");
        $page = "Редактирование блока";
        return view("block.edit")->with("block", $block)->with("topics", $topics)
        ->with("page", $page);
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
        $block = Block::find($id);
        $block->title = $request->title;
        $block->content = $request->content;
        $block->topicid =$request->topicid;
        $fname = $request->file("imagePath");
        if($fname!=null)
        {
            $filename = $request->file("imagePath")->getClientOriginalName();
            $request->file("imagePath")->move(public_path(). "/images", $filename);
            $block->imagePath = "/images/". $filename;
        }
        if(!$block->save()){
            $errors = $block->getErrors();
            return redirect()->route("block.edit", $block->id)->with("errors", $errors)->withInput();
        }
        return redirect("topic/". $block->topicid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $block = Block::find($id);
        $block->delete();
        return redirect("topic");
    }
}
