@extends('layouts.app')

@section('content')
    <br />
    <h3>掲示板トップ</h3>
    <br />

  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>タイトル</th>
      <th>投稿者</th>
      <th>内容</th>
    </tr>
    @foreach($articles as $article)
      <tr>
        <td align="center">{{ $article->title }}</td>
        <td align="center">{{ $article->name }}</td>
        <td align="center">{{ $article->body }}</td>
      </tr>
    @endforeach
  </table>

  <br/>
  <a href="/articles">{{ $user->name }}の投稿記事を見る</a>
@endsection
