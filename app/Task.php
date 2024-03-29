<?php

namespace apple;

use Illuminate\Database\Eloquent\Model;

use App\User;
class Task extends Model
{
    protected $fillable = ['name'];

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
