<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable=[
        'subject',
        'filepath',
        'filedate',
        'user_id',
        'keyword_id',
    ];


    // public function keywords()
    // {
    //     return $this->belongsTo('App\Models\Keyword', 'keyword_id');
    // }

    public function keyword(){
        return $this->belongsTo(Keyword::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function users()
    // {
    //     return $this->belongsTo('App\Models\User', 'user_id');
    // }
}
