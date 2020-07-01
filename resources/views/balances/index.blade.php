<form action="/balances">
    <table border="1" cellspacing="0" cellpadding="5">
      <tr align="left">
        <th>日</th>
        <td>
          <input type="date" name="date_from" value=@if (request('date_from')) {{request('date_from')}} @endif/>
          &nbsp～&nbsp
          <input type="date" name="date_to" value=@if (request('date_to')) {{request('date_to')}} @endif>
        </td>
      </tr>
      <tr align="left">
        <th>カテゴリ</th>
        <td>
          @foreach ($categories as $key => $val)
            <input type="checkbox" name="category[]" value="{{ $key }}"/ @if (request('category_id') && in_array($key, request('category_id'))) checked @endif>{{ $val }}
          @endforeach
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit">検索</button>
          <button type="button" onclick="location.href='/balance'">リセット</button>
        </td>
      </tr>
    </table>
  </from>

  <br/>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>購入日</th>
      <th>カテゴリ</th>
      <th>金額(円)</th>
      <th>メモ</th>
    </tr>
    @foreach($balances as $balance)
      <tr>
        <td>{{ \Carbon\Carbon::create($balance->transaction_date)->format('Y/m/d') }}</td>
        <td align="center">{{ $categories[$balance->category_id] }}</td>
        <td align="center">{{ $balance->amount }}</td>
        <td align="center">{{ $balance->memo }}</td>
      </tr>
    @endforeach
  </table>
