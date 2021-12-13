<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @method static LengthAwarePaginator paginate(int $i=15)
 */

class Post extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'body', 'id'];

    protected $appends = ['snippet'];

    protected $with = ['user'];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getSnippetAttribute(){
        $paragraphs = explode("\n\n", $this->body);
        return $paragraphs[0];
    }

    public function getDisplayBodyAttribute(){
        return nl2br($this->body);
    }
}
