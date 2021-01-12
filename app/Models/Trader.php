<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Trader extends Model
{
    protected $fillable = ['id', 'name'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function accounts () {
        return $this->hasMany(Account::class);
    }
}
