<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return Stock::all();
    }

    public function store(Request $request)
    {
        $stock = Stock::create($request->all());

        return response()->json($stock, 201);
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);
        $stock->fill($request->except(['id']));
        $stock->save();

        return response()->json($stock, 200);
    }

    public function destroy(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);

        if($stock->delete()) return response(null, 204);
    }
}
