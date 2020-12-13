<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image'
    ];
    protected $appends = [
        'full_image'
    ];

    public function getFullImageAttribute() {
        if ($this->image == null) {
            return null;
        }

        return request()->getSchemeAndHttpHost(). '/category_image/'. $this->image;
    }
}
