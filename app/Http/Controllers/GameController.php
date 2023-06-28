<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use File;
use DateTime;
use DateTimeZone;
// use Cookie;

class GameController extends Controller
{
    protected $host = "https://game-api.autotsm.com";
    protected $hostCustomer = "https://api-src.mydev.world/api/v1/customer";
    protected $hostGame = "https://api-src.mydev.world/api/v1/game/askmebet";
    protected $hostPlay = "https://api-src.mydev.world/api/v1/customer/askmebet/play";

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function history()
    {
        $data = $this->callHistory("/winloss/yesterday");
        dd($data);
        return view('game.history');
    }
    
    public function lobby()
    {
        $data = $this->callBrand("/api/hot");
        return view('game.lobby')->with('data',$data);
    }
    
    public function sport()
    {
        $data = $this->callBrand("/api/sport");
        return view('game.sport')->with('data',$data);
    }
    
    public function casino()
    {
        $data = $this->callBrand("/api/casino");
        return view('game.casino')->with('data',$data);
    }
    
    public function slot()
    {
        $data = $this->callBrand("/api/slot");
        return view('game.slot')->with('data',$data);
    }
    
    public function poker()
    {
        $data = $this->callBrand("/api/poker");
        return view('game.poker')->with('data',$data);
    }
    
    public function fish()
    {
        $data = $this->callBrand("/api/fish");
        return view('game.fish')->with('data',$data);
    }
    
    public function lotto()
    {
        $data = $this->callBrand("/api/lotto");
        return view('game.lotto')->with('data',$data);
    }
    
    public function esport()
    {
        $data = $this->callBrand("/api/esport");
        return view('game.esport')->with('data',$data);
    }
    
    public function trading()
    {
        $data = $this->callBrand("/api/trading");
        return view('game.trading')->with('data',$data);
    }
    
    public function keno()
    {
        $data = $this->callBrand("/api/keno");
        return view('game.keno')->with('data',$data);
    }

    public function callBrand($path){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-game').$path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: th",
                "content-type: application/json",
                'Origin:'.config('app.origin')
            ),
        ));

        $response = curl_exec($curl);
        // if ($response === false) {
        //     dd(curl_error($curl));
        //     dd(curl_errno($curl));
        // }
        // dd(curl_getinfo($curl));

        curl_close($curl);
        $data = json_decode($response, true);
        $value = [];
        if(isset($data["data"])){
            $value = $data["data"];
        }
        // dd($data);
        return $value;
    }

  
    public function slotList($code){
        $data = $this->callGame("/slot/".$code,"slot");
        if(empty($data)){
            $data["value"] = [];
            $data["code"] = "1131";
            $data["message"] = "ขณะนี้ระบบปิดปรับปรุง! ขออภัยในความไม่สะดวกค่ะ";
        }
        return view('game.slotList')->with('data',$data["value"])->with('code',$data["code"])->with('msg',$data["message"]);
    }

    public function pokerList($code){
        $data = $this->callGame("/poker/".$code,"poker");
        // dd($data);
        if(empty($data)){
            $data["value"] = [];
            $data["code"] = "1131";
            $data["message"] = "ขณะนี้ระบบปิดปรับปรุง! ขออภัยในความไม่สะดวกค่ะ";
        }
        return view('game.pokerList')->with('data',$data["value"])->with('code',$data["code"])->with('msg',$data["message"]);
    }

    public function callGame($path,$type){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->hostGame.$path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: th",
                "content-type: application/json",
                'Origin:'.config('app.origin')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        // dd($data);
        $value = array();
        $msg = "";
        // dd($data["result"]);
        if(isset($data["result"])){
            $result = $data["result"];
            if(isset($result["code"])){
                $msg = $result["message"];
                $value = array(
                    "code" => $result["code"],
                    "value" => [],
                    "message" => $msg
                );
            }else{
                if($type == "poker"){
                    $lists = $data["result"];
                }else{
                    $lists = $result["lists"];
                }
                $value = array(
                    "code" => "0",
                    "value" => $lists,
                    "message" => ""
                );
            }
        }
        return $value;
    }


    public function playSport($productcode){
        $data = $this->callPlay("/sport",$productcode,"-");
        // dd($data);
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }

        if($code == "0"){
            // header("Location: ".$data['url'] );
            // echo "<script> window.location(".$data['url'].");</script>" ;
            // From URL to get redirected URL

            // $url = $data["url"];
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            // $html = curl_exec($ch);
            // $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
            // curl_close($ch);
            // echo "Original URL:   " . $url . "<br/>";
            // echo "Redirected URL: " . $redirectedUrl . "<br/>";

            // $ch = curl_init($data["url"]);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            // curl_setopt($ch, CURLOPT_HEADER, TRUE); // We'll parse redirect url from header.
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE); // We want to just get redirect url but not to follow it.
            // $response = curl_exec($ch);
            // preg_match_all('/^Location:(.*)$/mi', $response, $matches);
            // curl_close($ch);
            // echo $response;
            // echo !empty($matches[1]) ? trim($matches[1][0]) : 'No redirect found';

            // header( "refresh: 2; url=".$data["url"] );
            // header( "location: ".$data["url"] );
            echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_self");
                        }
                    </script>
                ';
        }else{
            $msg = $this->checkErrorCode($code);
            return redirect()->route('sport',request()->segment(1))->with("message",$msg);
        }
        // else if($code == "999"){
        //     return redirect()->route('sport',request()->segment(1))->with("message","not_found");
        // }else if($code == "1030"){
        //     return redirect()->route('sport',request()->segment(1))->with("message","quick");
        // }else if($code == "1047" || $code == "1131"){
        //     return redirect()->route('casino',request()->segment(1))->with("message","mainternance");
        // }else{
        //     return redirect()->route('sport',request()->segment(1));
        // }
    }

    public function playCasino($productcode){
        $data = $this->callPlay("/baccarat",$productcode,"-");
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }
        
        if($code == "0"){
            echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_self");
                        }
                    </script>
                ';
        }else{
            $msg = $this->checkErrorCode($code);
            return redirect()->route('casino',request()->segment(1))->with("message",$msg);
        }
        // else if($code == "999"){
        //     return redirect()->route('casino',request()->segment(1))->with("message","not_found");
        // }else if($code == "1030"){
        //     return redirect()->route('casino',request()->segment(1))->with("message","quick");
        // }else if($code == "1047" || $code == "1131"){
        //     return redirect()->route('casino',request()->segment(1))->with("message","mainternance");
        // }else{
        //     return redirect()->route('casino',request()->segment(1));
        // }
    }
  
    public function playSlot($productcode,$gameid){
        $data = $this->callPlay("/".Session::get('Brand')."/play/slot",$productcode,$gameid);
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }
        if($code == "0"){
            echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_self");
                        }
                    </script>
                ';
        }else{
            $msg = $this->checkErrorCode($code);
            echo '
                <script>
                    window.onload = function(){
                        window.close();
                    }
                </script>
            ';
            // return redirect()->route('slot',request()->segment(1))->with("message",$msg);
        }
    }
  
    public function playPoker($productcode,$gameid){
        $data = $this->callPlay("/poker",$productcode,$gameid);
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }
        if($code == "0"){
            echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_self");
                        }
                    </script>
                ';
        }else{
            $msg = $this->checkErrorCode($code);
            return redirect()->route('poker',request()->segment(1))->with("message",$msg);
        }
        // else if($code == "999"){
        //     return redirect()->route('poker',request()->segment(1))->with("message","not_found");
        // }else if($code == "1030"){
        //     return redirect()->route('poker',request()->segment(1))->with("message","quick");
        // }else if($code == "1047" || $code == "1131"){
        //     return redirect()->route('poker',request()->segment(1))->with("message","mainternance");
        // }else{
        //     return redirect()->route('poker',request()->segment(1));
        // }
    }

    public function playLotto($productcode){
        $data = $this->callPlay("/amblotto",$productcode,"-");
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }
        if($code == "0"){
            echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_self");
                        }
                    </script>
                ';
        }else{
            $msg = $this->checkErrorCode($code);
            return redirect()->route('lotto',request()->segment(1))->with("message",$msg);
        }
        // else if($code == "999"){
        //     return redirect()->route('lotto',request()->segment(1))->with("message","not_found");
        // }else if($code == "1030"){
        //     return redirect()->route('lotto',request()->segment(1))->with("message","quick");
        // }else if($code == "1047" || $code == "1131"){
        //     return redirect()->route('lotto',request()->segment(1))->with("message","mainternance");
        // }else{
        //     return redirect()->route('lotto',request()->segment(1));
        // }
    }

    public function playEsport($productcode){
        $data = $this->callPlay("/esport",$productcode,"-");
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }
        if($code == "0"){
            echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_self");
                        }
                    </script>
                ';
        }else{
            $msg = $this->checkErrorCode($code);
            return redirect()->route('esport',request()->segment(1))->with("message",$msg);
        }
        // else if($code == "999"){
        //     return redirect()->route('esport',request()->segment(1))->with("message","not_found");
        // }else if($code == "1030"){
        //     return redirect()->route('esport',request()->segment(1))->with("message","quick");
        // }else if($code == "1047" || $code == "1131"){
        //     return redirect()->route('esport',request()->segment(1))->with("message","mainternance");
        // }else{
        //     return redirect()->route('esport',request()->segment(1));
        // }
    }

    public function playTrading($productcode){
        $data = $this->callPlay("/hotgraph",$productcode,"-");
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }
        if($code == "0"){
            echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_self");
                        }
                    </script>
                ';
        }else{
            $msg = $this->checkErrorCode($code);
            return redirect()->route('trading',request()->segment(1))->with("message",$msg);
        }
    }

    public function playKeno($productcode){
        $data = $this->callPlay("/keno",$productcode,"-");
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }
        if($code == "0"){
            echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_self");
                        }
                    </script>
                ';
        }else{
            $msg = $this->checkErrorCode($code);
            return redirect()->route('keno',request()->segment(1))->with("message",$msg);
        }
    }

    function callPlay($path,$productcode,$gameid){
        sleep(1);
        $AccessToken = Session::get('AccessToken');
        $payload = [
            "ProductCode" => $productcode,
            "GameId" => $gameid
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src').$path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: th",
                "content-type: application/json",
                'Origin:'.config('app.origin'),
                "Authorization: Bearer ".$AccessToken,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        // dd($data);
        $value = [];
        if(isset($data)){
            $value = $data;
        }
        return $value;
    }

    public function callHistory($path){
        $AccessToken = Session::get('AccessToken');
        // dd($AccessToken);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src').$path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: th",
                "content-type: application/json",
                'Origin:'.config('app.origin'),
                "Authorization: Bearer ".$AccessToken,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        // dd($data);
        if(isset($data["code"])){
            $code = $data["code"];
        }else{
            $code = null;
        }
        $value = [];
        if($code == "0"){
            $value = $data["data"];
        }
        return $value;
    }

    public function checkErrorCode($code){
        if($code == "999"){
            $msg = "not_found";
        }else if($code == "1030"){
            $msg = "quick";
        }else if($code == "1047" || $code == "1131"){
            $msg = "mainternance";
        }else if($code == "1006"){
            $msg = "lock";
        }else if($code == "1001"){
            $msg = "change";
        }else if($code == "1088"){
            $msg = "service";
        }else if($code == "9993"){
            $msg = "forwarding";
        }else{
            $msg = "";
        }
        return $msg;
    }
}
