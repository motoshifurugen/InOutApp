@extends('layouts.app')

@section('content')
    <br />
    <h3>みんなのポケモンページ</h3>
    <br />

  <form action="/allpokemons">
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
      <tr>
        <th>作った人</th>
        <td>
            @foreach($pokemon_user as $po_u)
            <input type="checkbox" name="name[]" value="{{ $po_u->name }}" @if(request('name') && in_array($po_u->name, request('name'))) checked @endif /> {{ $po_u->name }}
            @endforeach
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit">検索</button>
          <button type="button" onclick="location.href='/allpokemons'">リセット</button>
        </td>
      </tr>
    </table>
  </form>

  <br/>
  <h4>みんなのポケモン &nbsp; 表示中 {{ $pf['total'] }}体 / 全 {{ $count }}体</h4>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>作った人</th>
      <th>名前</th>
      <th>タイプ</th>
      <th>地方</th>
      <th>高さ</th>
      <th>重さ</th>
      <th>技の名前</th>
      <th>技の説明</th>
    </tr>
    @foreach($pokemons as $pokemon)
      <tr>
        <td align="center">{{ $pokemon->name }}</td>
        <td align="center">{{ $pokemon->pokemon_name }}</td>
        <td align="center">{{ $attributes[$pokemon->attribute] }}</td>
        <td align="center">{{ $regions[$pokemon->region] }}</td>
        <td align="center">{{ $pokemon->size }}cm</td>
        <td align="center">{{ $pokemon->weight }}kg</td>
        <td align="center">{{ $pokemon->attack_name }}</td>
        <td align="center">{{ $pokemon->attack_description }}</td>
      </tr>
    @endforeach
  </table>

  <br />
  {{ $pokemons->links() }}

  <br/>
  <a href="/pokemons">{{ $user->name }}のポケモンを見る</a>
@endsection
