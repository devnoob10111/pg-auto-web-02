<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;
use DateTime;
use Session;
use DateTimeZone;
use File;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }

    public function handle($request, Closure $next, ...$guards)
    {
        if(Session::has('AccessToken')){
            $Prefix = Session::get('Prefix');
            $Username = Session::get('Username');
            $Telephone = Session::get('Telephone');
            $AccessToken = Session::get('AccessToken');
            $RefreshToken = Session::get('RefreshToken');
            $AtExpires = Session::get('AtExpires');
            $RtExpires = Session::get('RtExpires');
            
            $date = new DateTime();
            $currentTimestamp = $date->getTimestamp();
            if($currentTimestamp >= $AtExpires){
                if($currentTimestamp < $RtExpires){
                    // get New AccessToken
                    $result = $this->generateToken($AccessToken,$RefreshToken);

                    $this->clearSession();
                    if($result == null){
                        return redirect()->route("login","prefix=".$Prefix);
                    }
                    $payload = $this->jwtPlayLoad($result["AccessToken"]);

                    Session::put('Prefix', $payload->prefix);
                    Session::put('Username', $payload->username);
                    Session::put('Telephone', $payload->telephone);
                    Session::put('AccessToken', $result["AccessToken"]);
                    Session::put('RefreshToken', $payload->refresh_token);
                    Session::put('AtExpires', $result["AtExpires"]);
                    Session::put('RtExpires', $result["RtExpires"]);
                    $account = $this->getAccountInfo();
                    Session::put('Name', $account["Name"]);
                    Session::put('Bank', $account["Bank"]);

                    $resp = $this->loadAgentPrefix($request->prefix);
                    if(!empty($resp) && $resp["code"] == "0"){
                        $data = $resp["data"];
                        Session::put('Origin', $data["Prefix"]);
                        config()->set('app.prefix',$data["Prefix"]);
                        config()->set('app.agent',$data["Agent"]);
                        config()->set('app.brand',$data["Brand"]);
                        config()->set('app.color-theme',$data["Color"]);
                        config()->set('app.owner',$data["Owner"]);
                        config()->set('app.logo',$data["Logo"]);
                        $base64 = $this->imageBase64($data["Logo"]);
                        config()->set('app.logo-base64',$base64);
                        config()->set('app.background',$data["Background"]);
                        config()->set('app.line',$data["LineOA"]);
                        
                        Session::put('Agent', $data["Agent"]);
                        Session::put('Brand', $data["Brand"]);
                        Session::put('ColorTheme', $data["Color"]);
                        Session::put('Owner', $data["Owner"]);
                        Session::put('Logo', $data["Logo"]);
                        Session::put('LogoBase64', $base64);
                        Session::put('Background', $data["Background"]);
                        Session::put('Line', $data["LineOA"]);
                    }

                    return $next($request);
                }else{
                    $this->clearSession();
                    return redirect()->route("login","prefix=".$Prefix);
                }
            }
                    
            $CreditTime = Session::get('CreditTime');
            if((time()-$CreditTime) > 5) {
                $credit = $this->getCredit();
                if(!empty($credit)){
                    if($credit["code"] == "0") {
                        Session::put('Credit', $credit["data"]);
                        Session::put('CreditTime', time());
                    }
                }
                // $point = $this->getPoint();
                // if(!empty($point)){
                //     if($point["code"] == "0") {
                //         Session::put('Point', $point["data"]);
                //         Session::put('PointTime', time());
                //     }
                // }
            }
            $result = $this->checkAccessToken($AccessToken);
            if(!empty($result["code"]) == "802"){
                $this->clearSession();
                return redirect()->route("login","prefix=".$Prefix);
            }
            return $next($request);
        }
        return redirect()->route("login","prefix=".$request->prefix);
    }

    public function jwtPlayLoad($token){
        $tokenParts = explode(".", $token);  
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        return $jwtPayload;
    }

    public function generateToken($accesstoken,$refreshtoken){
        $payload = [
                "accesstoken" => $accesstoken,
                "refreshtoken" => $refreshtoken
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/account/generate/token",
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
                "Authorization: Bearer ".$accesstoken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        // dd($data);
        if($data["code"] != "0"){
            return null;
        }
        return $data["data"];
    }

    public function checkAccessToken($AccessToken){
        // dd($AccessToken);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/status",
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

    public function getAccountInfo(){
        $AccessToken = Session::get('AccessToken');
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
                "accept: */*",
                "accept-language: th",
                "content-type: application/json",
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        $value = array(
            "Bank"=> "",
            "Bank_Th"=> "",
            "Bank_Account"=> "",
            "Name"=> "",
            "Balance"=> "",
            "Condition"=> ""
        );
        if(!empty($data["code"]) == "0" && !empty($data["data"]) != []){
            $value = $data["data"];
        }
        return $value;
    }

    public function getCredit(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/account/credit",
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

        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
    }

    public function getPoint(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/account/point",
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

        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function loadAgentPrefix($prefix){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/load/agent/prefix",
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
                'Origin:'.$prefix,
                'Prefix:'.$prefix
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
    }

    public function imageBase64($file){
        $image = $file;
        $type = explode(".",$image);
        $type = $type[1];
        if($type == "jpg" || $type == "jpeg"){
            $imageType = "image/jpeg";
        }else if($type == "png"){
            $imageType = "image/png";
        }
        $file = config('app.host').'/images/logo/'.$image;
        $source = file_get_contents($file);
        $imageData = base64_encode(file_get_contents($file));
        $imgBase64 = "data:". $imageType.";base64,".$imageData;
        return $imgBase64;
    }

    function clearSession(){
        Session::forget('Prefix');
        Session::forget('Username');
        Session::forget('Telephone');
        Session::forget('AccessToken');
        Session::forget('RefreshToken');
        Session::forget('AtExpires');
        Session::forget('RtExpires');
        Session::forget('Name');
        Session::forget('Bank');

        Session::forget('Origin');
        Session::forget('Agent');
        Session::forget('Brand');
        Session::forget('ColorTheme');
        Session::forget('Owner');
        Session::forget('Logo');
        Session::forget('LogoBase64');
        Session::forget('Background');
        Session::forget('Line');
    }
}
