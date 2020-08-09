@extends('layouts.app')

@section('content')
  <br/>
  <button type="button" onclick="location.href='/articles/create'">記事を作る</button>
  <br/>

  <br/>
  <h4>{{ $user->name }}の記事 &nbsp; 全 {{ $count }}記事</h4>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>タイトル</th>
      <th>内容</th>
      <th colspan="2"></th>
    </tr>
    @foreach($articles as $article)
      <tr>
        <td align="center">{{ $article->title }}</td>
        <td align="center">{{ $article->body }}</td>
        <td><button type="button" onclick="location.href='articles/{{ $article->id }}/edit'">編集</button></td>
        <td valign="middle">
            <form action="/articles/{{ $article->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </td>
      </tr>
    @endforeach
  </table>

  <br />
  <a href="/allarticles">掲示板を見る</a>
@endsection
