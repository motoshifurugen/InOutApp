@extends('layouts.app')

@section('content')
<form method="POST" action="/articles">
    {{ csrf_field() }}
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
          <th>タイトル</th>
          <td>
              <input type="text" name="title" require>
          </td>
      </tr>
      <tr>
        <th>内容</th>
        <td>
          <textarea name="body"></textarea>
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit" >投稿する</button>
        </td>
      </tr>
    </table>
  </form>

  <a href="/articles">戻る</a>
  @endsection
