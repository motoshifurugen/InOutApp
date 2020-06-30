<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

date_default_timezone_set('Asia/Tokyo');

class EventController extends Controller
{
    protected $IN_OUTS = ['IN' => '収入', 'OUT' => '支出'];
    protected $CATEGORIES = ['salary' => '給料', 'food' => '食費', 'fixed' => '固定費', 'eatingout' => '外食費', 'daily' => '日用品', 'fassion' => '服・美容', 'amusement' => '娯楽', 'transportasion' => '交通費', 'medical' => '医療費', 'other' => 'その他'];

    public function index()
    {
        $events = $this->getEvents();
        $performance = $this->calcPerformance($events);
        $in_outs = ['ALL' => '全て'] + $this->IN_OUTS;

        return view('events.index', compact('events'), ['pf' => $performance, 'categories' => $this->CATEGORIES, 'InOuts' =>$in_outs]);
    }

    public function create()
    {
        $ev = new Event();
        $ev->date = now();
        $ev->in_out = 'OUT';
        $ev->category = 'food';
        $ev->money = 0;

        return $this->createViewWithReturn($ev, 'create');
    }

    public function edit(Event $event)
    {
        return $this->createViewWithReturn($event, 'edit');
    }

    public function store()
    {
        $this->save();

        return redirect()->to('event');
    }

    public function update(Event $event)
    {
        $this->save($event);

        return redirect()->to('event');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->to('event');
    }

    function createViewWithReturn($ev, $type) {
        $ev->date = Carbon::parse($ev->date)->format('Y-m-d\TH:i');

        return view('events.save', compact('ev'), ['categories' => $this->CATEGORIES, 'InOuts' => $this->IN_OUTS, 'type' => $type]);
    }

    function save($data = null) {
        if ($data === null) {
            $data = new Event();
        }
        $data->date = request('date');
        $data->in_out = request('in_out');
        $data->category = request('category');
        $data->money = request('money');
        $data->memo = request('memo');
        $data->save();
    }

    function getEvents() {
        $query = DB::table('events');

        if (request('category')) {
            $query->whereIn('category', request('category'));
        }

        if(array_key_exists(request('in_out'), $this->IN_OUTS)) {
            $query->where('in_out', request('in_out'));
        }

        if(request('date_from') && !request('date_to')) {
            $query->where('date', '>=', request('date_from'));
        } else if (!request('date_from') && request('date_to')) {
            $query->where('date', '<=', request('date_to'));
        } else if (request('date_from') && request('date_to')) {
            $date_to = request('date_to');
            $query->whereBetween('date', [request('date_from'), $date_to]);
        }

        return $query->orderBy('date', 'desc')->get();
    }

    function calcPerformance($events) {
        $ret = [
            'total_in' => 0,
            'total_out' => 0,
            'in_out_money' => 0
        ];

        foreach ($events as $ev) {
            if($ev->in_out == 'OUT') {
                $ret['total_out'] += $ev->money;
            } else {
                $ret['total_in'] += $ev->money;
            }
        }
        $ret['in_out_money'] = $ret['total_in'] - $ret['total_out'];

        return $ret;
    }
}
