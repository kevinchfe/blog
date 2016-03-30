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
        'user_id'
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

    /**
     * 根据articles查找user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
     * 多对多
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }


    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }
}
