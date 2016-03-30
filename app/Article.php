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

    /**
     * ����articles����user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
     * ��Զ�
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
