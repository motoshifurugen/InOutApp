<?php

namespace App\Http\Controllers;

use App\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    // 認証を有効にする
    public function __construct() {
        $this->middleware('auth');
    }

    protected $CATEGORIES = ['0' => '入金', '1'=>'水', '2'=>'米'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id(); // ログインユーザIDを取得する
        $query = DB::table('balances')->where('user_id', $user_id);

        if (request('category_id')) {
            $query->whereIn('category_id', request('category_id'));
        }

        if (request('date_from') && request('date_to')) {
            $query->whereBetween('transaction_date', [request('date_from'), request('date_to')]);
        }

        $balances = $query->orderBy('transaction_date', 'desc')->get();

        return view('balances.index', compact('balances'), ['categories'=>$this->CATEGORIES]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {
        //
    }
}
