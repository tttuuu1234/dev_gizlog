<?php

namespace App\Models;
use App\Models\TagCategory;
use App\Models\User;
use App\Models\Comment;
use App\Services\SearchingScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use SearchingScope, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'tag_category_id',
    ];

    protected $dates = [
        'created_at',
        'update_at',
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'question_id');
    }

    public function fetchAllPersonalRecords($userId)
    {
        return $this->filterEqual('user_id', $userId)
                    ->orderby('created_at', 'desc')
                    ->get();
    }

    public function fetchSearchWordRecords($inputs)
    {
        return $this->filterLike('title', $inputs['search_word'])
                    ->filterEqual('tag_category_id', $inputs['tag_category_id'])
                    ->orderby('created_at', 'desc')
                    ->get();
    }
}

