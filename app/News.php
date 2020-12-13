<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'sub_title',
        'content',
        'image',
        'author',
        'source_id',
        'category_id'
    ];
    protected $appends = [
        'full_image'
    ];

    public function source()
    {
        return $this->belongsTo('App\Source', 'source_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function getFullImageAttribute() {
        if ($this->image == null) {
            return null;
        }

        return request()->getSchemeAndHttpHost(). '/news_image/'. $this->image;
    }
}
