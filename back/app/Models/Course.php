<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function module():BelongsTo{
        return $this->belongsTo(Module::class);
    }
    public function professeur():BelongsTo{
        return $this->belongsTo(User::class,"user_id");
    }
    public function param():BelongsTo{
        return $this->belongsTo(Param::class);
    }

    
}
