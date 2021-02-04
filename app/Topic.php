<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $primaryKey = "id";
    protected $table = "topics";
    protected $fillable = ["topicname", "created_at", "updated_at"];
}
