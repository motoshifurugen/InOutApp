<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class RecruitController extends Controller {
    public function index() {
        $url = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=59f59a9216f64e32&large_service_area=SS10&format=json';
        $data = file_get_contents($url);
        $json = json_decode($data, true);
        $shops = $json['results']['shop'];
        // dd($shops);
        return view('recruit.index', compact('shops'));

    }
}
