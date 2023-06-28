<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Session;
use File;
use DateTime;
use DateTimeZone;

class AuthController extends Controller
{
    public function jwtPlayLoad($token){
        $tokenParts = explode(".", $token);  
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        return $jwtPayload;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function registerRef()
    {
        return View('auth.login'); 
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){
        $this->validate($request, [
            'telephone' => 'required',
            'password' => 'required',
            // 'g-recaptcha-response' => 'required|recaptchav3:login,0.5'
        ]);
        $telephone = str_replace("-","",$request->telephone);
        
        $payload = [
                "Telephone" => $telephone,
                "Password" => $request->password
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/login",
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
                // "content=text/html; charset=utf-8",
                "content-type: application/json",
                'Origin:'.Session::get('Origin')
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        if(Session::has('Prefix')){
            $prefix = Session::get('Prefix');
        }else{
            $prefix = config('app.prefix');
        }
        
        if(isset($data) && ($data["code"] == "0")){
            $result = $data["data"];
            $payload = $this->jwtPlayLoad($result["AccessToken"]);
            Session::put('Prefix', $payload->prefix);
            Session::put('Username', $payload->username);
            Session::put('Password', $request->password);
            Session::put('Telephone', $payload->telephone);
            Session::put('AccessToken', $result["AccessToken"]);
            Session::put('RefreshToken', $payload->refresh_token);
            Session::put('AtExpires', $result["AtExpires"]);
            Session::put('RtExpires', $result["RtExpires"]);
            $account = $this->getAccountInfo($result["AccessToken"]);
            Session::put('Name', $account["Name"]);
            Session::put('Bank', $account["Bank"]);

            Session::put('Origin', config('app.origin'));
            Session::put('Agent', config('app.agent'));
            Session::put('Brand', config('app.brand'));
            Session::put('ColorTheme', config('app.color-theme'));
            Session::put('Owner', config('app.owner'));
            Session::put('Logo', config('app.logo'));
            Session::put('LogoBase64', config('app.logo-base64'));
            Session::put('Background', config('app.background'));
            Session::put('Line', config('app.line'));

            $banner = $this->getBanner();
            if(isset($banner["code"]) && $banner["code"] == "0"){
                $pagination = $banner["data"];
                $data = $pagination["data"];
                Session::put('BannerCount', count($data));
                foreach($data as $i => $val){
                    Session::put('Banner'.$i, $val["Picture"]);
                }
            }
            
            return redirect()->route("wallet","prefix=".Session::get('Prefix'));
        }else if(isset($data) && ($data["code"] != "0")){
            return redirect()->route("login","prefix=".$prefix)->with("message",$data["code"])->with("telephone",$request->telephone)->with("password",$request->password);
        }else{
            return redirect()->route("login","prefix=".$prefix)->with("telephone",$request->telephone)->with("password",$request->password);
        }
    }

    public function register(Request $request){
        //Save Log
        $path = "log";
        $date = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
        if (!is_dir($path)) {  mkdir($path,0777,true);  }
        File::append($path."/".$date->format('Y-m-d').'_register_log.txt', "\n\r".$date->format('Y/m/d H:i:s')." => \n".json_encode($request->all()));

        if(!empty($request->ref)){
            $ref = $request->ref;
        }else{
            $ref = " ";
        }
        $telephone = str_replace("-","",$request->telephone);
        // $telephone = $request->telephone;
        $bank_account = $request->bank_account;
        $data = array("result"=>"Failed!","message"=>"ป้อนเบอร์หรือเลขบัญชีเฉพาะตัวเลขเท่านั้น");
        if(str_contains($telephone, '.') || str_contains($bank_account, '.')){
            return response()->json($data);
        }
        if(!is_numeric($telephone)){
            return response()->json($data);
        }else if(!is_numeric($bank_account)){
            return response()->json($data);
        }

        if(Session::has('Prefix')){
            $prefix = Session::get('Prefix');
        }else{
            $prefix = config('app.prefix');
        }
        $payload = [
                "telephone" => $telephone,
                "password" => $request->password,
                "bank" => $request->bank,
                "bank_account" => $bank_account,
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "channel" => $request->channel,
                "id_line" => $request->id_line,
                "bonus" => $request->bonus,
                "prefix" => $prefix,
                "lineid" => " ",
                "ref" => $ref
        ];
        // return response()->json($payload);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/register",
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
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return response()->json($data);
    }
    
    public function verification(Request $request){
        $payload = [
                "bank" => $request->bank,
                "bank_account" => $request->bank_account
        ];
        $bank_account = $request->bank_account;
        $data = array("code"=>"800","message"=>"ป้อนเลขบัญชีเฉพาะตัวเลขเท่านั้น");
        if(str_contains($bank_account, '.')){
            return response()->json($data);
        }
        if(!is_numeric($bank_account)){
            return response()->json($data);
        }
        // return response()->json($payload);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/verification",
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
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return response()->json($data);
    }

    public function getBankList(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/bank/list",
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
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return response()->json($data);
    }

    public function getAccessToken($prefix,$token){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/token/web?token=".$token,
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
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return response()->json($data);
    }

    public function generateToken(Request $request){
        $payload = [
                "accesstoken" => $request->accesstoken,
                "refreshtoken" => $request->refreshtoken
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/generate/token",
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
                "Authorization: Bearer ".$request->token,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return response()->json($data);
    }

    public function getAccountInfo($AccessToken){
        // $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/account/info",
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
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        $value = array(
            "Bank"=> "",
            "Bank_Account"=> "",
            "Bank_Name"=> "",
            "Bank_Th"=> "",
            "Name"=> "",
            "Balance"=> "",
            "Condition"=> ""
        );
        if(!empty($data["code"]) == "0" && !empty($data["data"]) != []){
            $value = $data["data"];
        }
        return $value;
    }
    
    public function getBanner(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/banner/list?limit=50&page=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: */*",
                "accept-language: th",
                "content-type: application/json",
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
    }
}
