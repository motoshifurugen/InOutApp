<form method="POST" action="/balances">
    {{ csrf_field() }}
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
        <th>日</th><td><input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" require></td>
      </tr>
      <tr>
        <th>カテゴリ</th>
        <td>
        <select name="category_id">
          @foreach ($categories as $key => $val)
            <option value="{{ $key }}" >{{ $val }}</option>
          @endforeach
        </select>
        </td>
      </tr>
      <tr>
        <th>金額(円)</th>
        <td>
          <input type="number" name="amount" value="0" require>
        </td>
      </tr>
      <tr>
        <th>メモ</th>
        <td>
          <textarea name="memo"></textarea>
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit" >登録</button>
        </td>
      </tr>
    </table>
  </form>

  <a href="/balances">戻る</a>
