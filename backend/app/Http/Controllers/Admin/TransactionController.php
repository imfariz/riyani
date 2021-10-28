<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $items = Transaction::all();
        return view('pages.admin.transaction.index', [
            'items' => $items
        ]);
    }

    public function show($id)
    {
        $item = Transaction::with('details.product')->findOrFail($id);

        return view('pages.admin.transaction.show')->with([
            'item' => $item
        ]);
    }

    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.admin.transaction.edit')->with([
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Transaction::findOrFail($id);
        $item->update($data);

        return redirect()->route('transactions.index');
    }

    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();

        return redirect()->route('transactions.index');
    }
    
    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = Transaction::findOrFail($id);
        $item->transaction_status = $request->status;

        $item->save();

        return redirect()->route('transactions.index');
    }
}
