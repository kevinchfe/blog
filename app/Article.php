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

    //��published_at��ΪCarbon����
    protected $dates = ['published_at'];

    //�޸���
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    //��ѯ������
    public function scopePublished($query)
    {
        return $query->where('published_at','<=',Carbon::now());
    }
}
