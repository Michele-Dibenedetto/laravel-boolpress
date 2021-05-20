<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["data_publicazione", "immagine_profilo", "testo", "titolo", "slug", "user_id"];

    public function user() {
        return $this->belongsTo("App\User");
    }
}
