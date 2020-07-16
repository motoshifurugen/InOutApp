@extends('layouts.app')

@section('content')
<div>
    <br />
    <h2>ポケモンを作ろう</h2>
    <br />
    <p>
        自分で考えたポケモンを作ったり、みんなの考えたポケモンを見れるアプリだよ。タイプや技の名前も考えることができるよ。さあ、さっそく作ってみよう！
    </p>
</div>
<div>
    <p>みんなが作ったポケモンの数 &nbsp; 合計 {{ $count }}体</p>
    <button type="button" onclick="location.href='/allpokemons'">みんなのポケモンを見にいく</button>
</div>
<br />
<div>
    <button type="button" onclick="location.href='/pokemons/create'">自分のポケモンを作ってみる</button>
</div>
  @endsection
