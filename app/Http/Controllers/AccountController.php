<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return Account::all();
    }

    public function store(Request $request)
    {
        $account = Account::create($request->all());

        return response()->json($account, 201);
    }

    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $account->fill($request->except(['id', 'trader_id', 'stock_id']));
        $account->save();

        return response()->json($account, 200);
    }

    public function destroy(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        if($account->delete()) return response(null, 204);
    }
}
