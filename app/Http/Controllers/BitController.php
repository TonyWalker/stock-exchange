<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bit;
use App\Models\Deal;
use Illuminate\Http\Request;

class BitController extends Controller
{
    public function index()
    {
        return Bit::all();
    }

    public function store(Request $request)
    {
        $deal = Deal::findOrFail($request->input('deal_id'));
        if ($deal->amount < $request->input('amount'))
        {
            return response()->json('Limit is exceeded', 400);
        } else
        {
            $bit = Bit::create($request->all());
            return response()->json($bit, 201);
        }
    }

    public function destroy(Request $request, $id)
    {
        $bit = Bit::findOrFail($id);

        if($bit->delete()) return response(null, 204);
    }

    public function approve(Request $request, $id)
    {
        $bit = Bit::findOrFail($id);
        $deal = Deal::findOrFail($bit->deal_id);
        $tr_acc = Account::findOrFail($deal->account_id);
        if ($bit->amount < $deal->amount)
        {
            $tr_acc->amount -= $bit->amount;
            $tr_acc->save();

            $deal->amount -= $bit->amount;
            $deal->save();

            $purch = Account::firstOrCreate(array('trader_id' => $bit->trader_id, 'stock_id' => $tr_acc->stock_id));
            $purch->amount += $bit->amount;
            $purch->save();

            $bit->delete();

            return response(null, 204);
        } else
        {
            $purch = Account::firstOrCreate(array('trader_id' => $bit->trader_id, 'stock_id' => $tr_acc->stock_id));
            $purch->amount += $bit->amount;
            $purch->save();

            $tr_acc->amount -=$bit->amount;
            $tr_acc->save();
            $deal->delete();
            $bit->delete();

            return response(null, 204);
        }
    }

}
