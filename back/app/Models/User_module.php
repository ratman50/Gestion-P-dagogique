<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User_module extends Model
{
    use HasFactory;
    protected $table='user_modules';

    public function module():BelongsTo{
        return $this->belongsTo(Module::class);
    }
    public function professeur():BelongsTo{
        return $this->belongsTo(User::class,"user_id");
    }
}
