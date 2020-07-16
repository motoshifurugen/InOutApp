<table border="1" cellspacing="0" cellpadding="5">
    <tr><td>ID</td><td>店名</td><td>住所</td><td>画像</td></tr>
  @foreach ($shops as $i => $shop)
    <tr><td>{{ $shop['id'] }}</td><td>{{ $shop['name'] }}</td><td>{{ $shop['address'] }}</td><td><img src="{{$shop['logo_image']}}"/></td></tr>
  @endforeach
  </table>
