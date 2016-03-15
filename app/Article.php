<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
        'published_at',
    ];

    //将published_at变为Carbon对象
    protected $dates = ['published_at'];

    //修改器
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    //查询作用域
    public function scopePublished($query)
    {
        return $query->where('published_at','<=',Carbon::now());
    }
}
