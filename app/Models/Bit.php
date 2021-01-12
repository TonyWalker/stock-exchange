<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Bit extends Model
{
    protected $fillable = ['id', 'deal_id', 'trader_id', 'amount'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function deal ()
    {
        return $this->belongsTo(Deal::class);
    }
}
