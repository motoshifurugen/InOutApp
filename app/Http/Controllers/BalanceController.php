<?php

namespace App\Http\Controllers;

use App\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // 認証モジュールの読み込み

class BalanceController extends Controller {
    // 認証を有効にする
    public function __construct() {
        $this->middleware('auth');
    }

    // 項目マスタ キーとラベル
    protected $CATEGORIES = ['0' => 'なし', '1'=>'水', '2'=>'米'];

    public function index() {
        $user_id = Auth::id(); // ログインユーザIDを取得する

        $query = DB::table('balances')->where('user_id', $user_id);

        if (request('category_id')) {
            $query->whereIn('category_id', request('category_id'));
        }

        if (request('date_from') && request('date_to')) {
            $query->whereBetween('transaction_date', [request('date_from'), request('date_to')]);
        }

        $balances = $query->orderBy('transaction_date', 'desc')->get();

        $performance = $this->calcPerformance($balances);

        return view('balances.index', compact('balances'), ['categories'=>$this->CATEGORIES, 'pf' => $performance]);
    }

    public function create() {
        return view('balances.create', ['categories'=>$this->CATEGORIES]);
    }

    public function store(Request $request) {
        // var_dump(1);
        $balance = new Balance();
        $balance->user_id = Auth::id();
        $balance->category_id = request('category_id');
        $balance->transaction_date = request('transaction_date');
        $balance->amount = request('amount');
        if (request('memo')) {
            $balance->memo = request('memo');
        }

        $balance->save();
        return redirect('balances');
    }

    public function edit(Balance $balance) {
        // var_dump(1);
        return view('balances.edit', compact('balance'), ['categories'=>$this->CATEGORIES]);
    }

    public function update(Balance $balance) {
        // var_dump(1);
        $balance->user_id = Auth::id();
        $balance->category_id = request('category_id');
        $balance->transaction_date = request('transaction_date');
        $balance->amount = request('amount');
        if (request('memo')) {
            $balance->memo = request('memo');
        }
        $balance->save();
        return redirect('balances');
    }

    public function destroy(Balance $balance) {
        // var_dump(1);
        $balance->delete();

        return redirect()->to('balances');
    }

    public function calcPerformance($balances) {
        $ret = [
            'total_in' => 0,
            'total_out' => 0,
            'total_inout' => 0
        ];

        foreach ($balances as $ba) {
            if ($ba->amount >= 0) {
                $ret['total_in'] += $ba->amount;
            } else {
                $ret['total_out'] += $ba->amount;
            }
        }
        $ret['total_inout'] = $ret['total_in'] + $ret['total_out'];

        return $ret;
    }
}
