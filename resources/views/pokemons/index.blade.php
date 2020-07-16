@extends('layouts.app')

@section('content')
    <br />
    <h3>{{ $user->name }}のポケモンページ</h3>
    <br />

  <form action="/pokemons">
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
        <th>タイプ</th>
        <td>
            @foreach($attributes as $key => $val)
            <input type="checkbox" name="attribute[]" value="{{ $key }}" @if(request('attribute') && in_array($key, request('attribute'))) checked @endif /> {{ $val }}
            @endforeach
        </td>
      </tr>
      <tr>
        <th>地方</th>
        <td>
            @foreach($regions as $key => $val)
            <input type="checkbox" name="region[]" value="{{ $key }}" @if(request('region') && in_array($key, request('region'))) checked @endif /> {{ $val }}
            @endforeach
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit">検索</button>
          <button type="button" onclick="location.href='/pokemons'">リセット</button>
        </td>
      </tr>
    </table>
  </form>

  <br/>
  <button type="button" onclick="location.href='/pokemons/create'">新しくポケモンを作る</button>
  <br/>

  <br/>
  <h4>{{ $user->name }}のポケモン &nbsp; 表示中 {{ $pf['total'] }}体 / 全 {{ $count }}体</h4>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>名前</th>
      <th>タイプ</th>
      <th>地方</th>
      <th>高さ</th>
      <th>重さ</th>
      <th>技の名前</th>
      <th>技の説明</th>
      <th colspan="2"></th>
    </tr>
    @foreach($pokemons as $pokemon)
      <tr>
        <td align="center">{{ $pokemon->pokemon_name }}</td>
        <td align="center">{{ $attributes[$pokemon->attribute] }}</td>
        <td align="center">{{ $regions[$pokemon->region] }}</td>
        <td align="center">{{ $pokemon->size }}cm</td>
        <td align="center">{{ $pokemon->weight }}kg</td>
        <td align="center">{{ $pokemon->attack_name }}</td>
        <td align="center">{{ $pokemon->attack_description }}</td>
        <td><button type="button" onclick="location.href='pokemons/{{ $pokemon->id }}/edit'">編集</button></td>
        <td valign="middle">
            <form action="/pokemons/{{ $pokemon->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </td>
      </tr>
    @endforeach
  </table>

  <br />
  {{ $pokemons->links() }}

  <br/>
  <a href="/allpokemons">みんなのポケモンを見る</a>
@endsection
