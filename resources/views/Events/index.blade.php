<style>
* {
    font-size: 0.9rem;
}
h4 {
    padding: 0.25em 0.5em;
    border-left: solid 5px blue;
}
th {
    background-color: gray;
    color: white;
    font-weight: normal;
}
</style>

<form action="/event">
    <table border="1" cellspacing="0" cellpadding="5">
        <tr align="left">
            <th>期間</th>
            <td>
                <input type="date" name="date_from" value= @if(request('date_from')) {{ request('date_from') }} @endif />
                &nbsp ~
                <input type="date" name="date_to" value= @if(request('date_to')) {{ request('date_to') }} @endif />
            </td>
        </tr>
        <tr align="left">
            <th>収支</th>
            <td>
                @foreach ($InOuts as $key => $val)
                    <input type="radio" name="in_out" value="{{ $key }}" @if (!request('in_out') && $key == 'ALL' || request('in_out') == $key) checked @endif />{{ $val }}
                @endforeach
            </td>
        </tr>
        <tr align="left">
            <th>項目</th>
            <td>
                @foreach($categories as $key => $val)
                    <input type="checkbox" name="category[]" value="{{ $key }}" @if(request('category') && in_array($key, request('category'))) checked @endif /> {{ $val }}
                @endforeach
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <button type="submit">検索</button>
                <button type="button" onclick="location.href='/event'">リセット</button>
            </td>
        </tr>
    </table>
</form>

<h4>統計</h4>
<table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
        <th>収入合計</th>
        <th>支出合計</th>
        <th>収支合計</th>
    </tr>
    <tr align="right">
        <td>{{ $pf['total_in'] }}円</td>
        <td>{{ $pf['total_out'] }}円</td>
        <td>{{ $pf['in_out_money'] }}円</td>
    </tr>
</table>

<h4>明細</h4>
<button type="button" onclick="location.href='/event/create'">登録</button>
<br />
<br />
<table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
        <th>日時</th>
        <th>収支</th>
        <th>項目</th>
        <th>金額</th>
        <th>メモ</th>
        <th colspan="2">操作</th>
    </tr>
    @foreach($events as $ev)
    <tr>
        <td>{{ \Carbon\Carbon::create($ev->date)->format('Y/m/d h:i') }}</td>
        <td align="center">{{ $InOuts[$ev->in_out] }}</td>
        <td align="center">{{ $categories[$ev->category] }}</td>
        <td align="right">{{ $ev->money }}円</td>
        <td>{{ $ev->memo }}</td>
        <td><button type="button" onclick="location.href='event/{{ $ev->id }}/edit'">編集</button></td>
        <td valign="middle">
            <form action="/event/{{ $ev->id }}" method="POST" style="display: inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>




