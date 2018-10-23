<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';
    
    public function usuario()
    {
        return User::where('id', $this->user_id)->first()->name;
    }

}
