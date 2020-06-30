<style>
*{
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

@if($type == 'create')
<form method="POST" action="/event">
@else
<form method="POST" action="/event/{{ $ev->id }}">
    @method('PUT')
@endif

@csrf
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>日時</th>
        <td><input type="datetime-local" name="date" value="{{ $ev->date }}" required ></td>
    </tr>
    <tr>
        <th>収支</th>
        <td>
            @foreach ($InOuts as $key => $val)
                <input type="radio" name="in_out" value="{{ $key }}" @if ($ev->in_out == $key) checked @endif>{{ $val }}
            @endforeach
        </td>
    </tr>
    <tr>
        <th>項目</th>
        <td>
            <select name="category">
                @foreach ($categories as $key => $val)
                    <option value="{{ $key }}" @if ($ev->category == $key) selected @endif >{{ $val }}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <th>金額</th>
        <td><input type="number" name="money" value="{{ $ev->money }}" required>円</td>
    </tr>
    <tr>
        <th>メモ</th>
        <td><textarea name="memo" value="{{ $ev->memo }}"></textarea></td>
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

<a href="/event">戻る</a>

