<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Deal;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class DealController extends Controller
{
    public function index()
    {
        return Deal::all();
    }

    public function store(Request $request)
    {
        $stock = Account::findOrFail($request->input('account_id'));
        if ($stock->amount <= $request->input('amount'))
        {
            return response()->json('Limit is exceeded', 400);
        } else
        {
            $deal = Deal::create($request->all());
            return response()->json($deal, 201);
        }
    }

    public function destroy(Request $request, $id)
    {
        $deal = Deal::findOrFail($id);

        if(empty($deal->bits[0]))
        {
            if($deal->delete()) return response(null, 204);

        } else
        {
            return response()->json('Operate bits before', 400);
        }
    }
}
