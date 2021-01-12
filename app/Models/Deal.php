<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Deal extends Model
{
    protected $fillable = ['id', 'account_id', 'amount'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function account ()
    {
        return $this->belongsTo(Account::class);
    }

    public function bits () {
        return $this->hasMany(Bit::class);
    }
}
