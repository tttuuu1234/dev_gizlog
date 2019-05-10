<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\SearchingScope;

class DailyReport extends Model
{
    //
    use SoftDeletes, SearchingScope; 

    protected $fillable = [
        'title',
        'contents',
        'reporting_time',
        'user_id'
    ];
    
    protected $dates = ['reporting_time', 'deleted_at'];

    public function fetchSearchingQuestion($conditions)
    {
        return $this->filterLike('reporting_time', $conditions['search_word'])
                    ->orderby('created_at', 'desc');
    }
}
