@if($type == 'create')
<form method="POST" action="/balance">
@else
<form method="POST" action="/balance/{{ $ba->id }}">
    @method('PUT')
@endif

@csrf
<table border="1" cellspacing="0" cellpadding="5">
    <tr align="left">
        <th>日</th>
        <td><input type="datetime-local" name="transaction_date" value="{{ $ba->transaction_date }}" required ></td>
    </tr>
    <tr align="left">
        <th>カテゴリ</th>
        <td>
            <select name="category_id">
                @foreach ($categories as $key => $val)
                    <option value="{{ $key }}" @if ($ba->category == $key) selected @endif >{{ $val }}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr align="left">
        <th>金額(円)</th>
        <td><input type="number" name="amount" value="{{ $ba->amount }}" required></td>
    </tr>
    <tr>
        <th>メモ</th>
        <td><textarea name="memo" value="{{ $ba->memo }}"></textarea></td>
    </tr>
    <tr align="center">
        <td colspan="2"><button type="submit">{{ $type == 'create' ? '登録' : '更新' }}</button></td>
    </tr>
</table>
</form>

@if ($errors->any())
<ul>
    @foreach($errors->all() as $error)
        <li style="color:red">{{ $error }}</li>
    @endforeach
</ul>
@endif

<a href="/balance">戻る</a>

