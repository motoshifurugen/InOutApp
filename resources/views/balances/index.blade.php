{{-- <form action="/balance">
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
            <input type="checkbox" name="category_id[]" value="{{ $key }}"/ @if (request('category_id') && in_array($key, request('category_id'))) checked @endif>{{ $val }}
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
  <button type="button" onclick="location.href='/balance/create'">登録</button>

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
  </table> --}}
  <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

  <form action="/balances">
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
        <th>購入日</th>
        <td>
            <input type="date" name="date_from" value=@if(request('date_from')) {{ request('date_from') }} @endif />
            &nbsp ~
            <input type="date" name="date_to" value=@if(request('date_to')) {{ request('date_to') }} @endif />
        </td>
      </tr>
      <tr>
        <th>カテゴリ</th>
        <td>
            @foreach($categories as $key => $val)
            <input type="checkbox" name="category_id[]" value="{{ $key }}" @if(request('category_id') && in_array($key, request('category_id'))) checked @endif /> {{ $val }}
            @endforeach
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit">検索</button>
          <button type="button" onclick="location.href='/balances'">リセット</button>
        </td>
      </tr>
    </table>
  </form>

  <br/>

  <table border="1" cellspacing="0" cellpadding="5">
      <tr align="center">
          <th>収入合計</th>
          <th>支出合計</th>
          <th>収支合計</th>
      </tr>
      <tr align="right">
          <td>{{ $pf['total_in'] }}円</td>
          <td>{{ $pf['total_out'] }}円</td>
          <td>{{ $pf['total_inout'] }}円</td>
      </tr>
  </table>

  <br/>

  <button type="button" onclick="location.href='/balances/create'">登録</button>

  <br/>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>購入日</th>
      <th>カテゴリ</th>
      <th>金額(円)</th>
      <th>メモ</th>
      <th colspan="2"></th>
    </tr>
    @foreach($balances as $balance)
      <tr>
        <td>{{ \Carbon\Carbon::create($balance->transaction_date)->format('Y/m/d') }}</td>
        <td align="center">{{ $categories[$balance->category_id] }}</td>
        <td align="center">{{ $balance->amount }}</td>
        <td align="center">{{ $balance->memo }}</td>
        <td><button type="button" onclick="location.href='balances/{{ $balance->id }}/edit'">編集</button></td>
        <td valign="middle">
            <form action="/balances/{{ $balance->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </td>
      </tr>
    @endforeach
  </table>

</body>
</html>
