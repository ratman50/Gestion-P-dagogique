<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function param(): BelongsTo
    {
        return $this->belongsTo(Param::class);
    }

    public function userModule():BelongsTo{
        return $this->belongsTo(User_module::class,"user_module");
    }
}
