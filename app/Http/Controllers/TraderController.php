<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Trader;
use Illuminate\Http\Request;

class TraderController extends Controller
{
    public function index()
    {
        return Trader::all();
    }

    public function store(Request $request)
    {
        $trader = Trader::create($request->all());

        return response()->json($trader, 201);
    }

    public function stock($id, $st_id)
    {
        $data = Account::where('trader_id', $id)->get();
        if (empty($data[0]))
        {
            return response()->json('Trader doesn`t have accounts', 400);
        } else
        {
            $stock = $data->where('stock_id', $st_id);
            if (empty($stock[0]))
            {
                return response()->json('Trader doesn`t have stocks of specific company', 400);
            }
            return response()->json($stock[0]->amount, 200);

        }
    }

    public function update(Request $request, $id)
    {
        $trader = Trader::findOrFail($id);
        $trader->fill($request->except(['id']));
        $trader->save();

        return response()->json($trader, 200);
    }

    public function destroy(Request $request, $id)
    {
        $trader = Trader::findOrFail($id);

        if($trader->delete()) return response(null, 204);
    }
}
