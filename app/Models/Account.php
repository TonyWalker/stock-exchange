<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Account extends Model
{
    protected $fillable = ['id', 'stock_id', 'trader_id', 'amount'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function trader () {
        return $this->belongsTo(Trader::class);
    }

    public function stock () {
        return $this->belongsTo(Stock::class);
    }

    public function deals () {
        return $this->hasMany(Deal::class);
    }
}
