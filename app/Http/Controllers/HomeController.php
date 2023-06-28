<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Notification;
// use Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pageWallet()
    {
        $lose = $this->cashBackLoseList();
        return view('wallet')->with("lose",$lose);
    }

    public function pageDeposit()
    {
        return view('deposit');
    }

    public function pageDepositBank()
    {
        $data = $this->getBankDeposit();
        if(!empty($data)){
            $dataBank = $data[0];
        }else{
            $dataBank = null;
        }
        return view('deposit.bank')->with("data",$dataBank);
    }

    public function pageDepositWallet()
    {
        $truewallet = $this->getTruewalletDeposit();
        if(!empty($truewallet[0])){
            $truewallet = $truewallet[0];
        }else{
            $truewallet["Telephone"] = null;
        }
        return view('deposit.wallet')->with("truewallet",$truewallet);
    }

    public function pageWithdraw()
    {
        $credit = $this->getCredit();
        $account = $this->getAccountInfo();
        return view('withdraw')->with("account",$account)->with("credit",$credit->getData()->data);
    }

    public function pagePromotion()
    {
        $promotionList = $this->getPromotionList();
        if(!empty($promotionList)){
            $list = $promotionList["data"];
        }else{
            $list = [];
        }
        $promotion = $this->getPromotion();
        
        if(isset($promotion["code"]) && $promotion["code"] == "0"){
            return view('promotion')->with("data",$promotion["data"])->with("list",$list);
        }else{
            return view('promotion')->with("msg",$promotion["message"])->with("list",$list);
        }
    }
    
    public function pageTransactionsDeposit()
    {
        $transactions = $this->getTransactions("deposit");
        return view('transactions.deposit')->with("data",$transactions);
    }
    
    public function pageTransactionsWithdraw()
    {
        $transactions = $this->getTransactions("withdraw");
        return view('transactions.withdraw')->with("data",$transactions);
    }
    
    public function pageTransactionsOther()
    {
        $transactions = $this->getTransactions("other");
        return view('transactions.other')->with("data",$transactions);
    }
    
    public function pageProfile()
    {
        $account = $this->getAccountInfo();
        return view('profile')->with("account",$account);
    }
    
    public function pageAffiliate()
    {
        $affiliate = $this->getAffiliate();
        $affiliateCredit = $this->getAffiliateCreditSummary();
        return view('affiliate')->with("affiliate",$affiliate)->with("summary",$affiliateCredit);
    }

    public function pageLuckyWheel()
    {
        return view('wheel');
    }

    public function pageWheelHistory($limit,$page){
        $data = $this->getWheelHistory($limit,$page);
        return view('wheelHistory')->with("data",$data);
    }

    public function pageRanking()
    {
        return view('ranking');
    }

    public function pageAccount()
    {
        $account = $this->getAccountInfo();
        return view('account')->with("account",$account);
    }

    public function pageGame()
    {
        if(Session::get('Brand') == "askmebet"){
            $data = $this->callGame("/slot/pg","slot");
            if(empty($data)){
                $data["value"] = [];
                $data["code"] = "1131";
                $data["message"] = "ขณะนี้ระบบปิดปรับปรุง! ขออภัยในความไม่สะดวกค่ะ";
            }
            return view('game')->with('data',$data["value"])->with('code',$data["code"])->with('msg',$data["message"]);
        }else if(Session::get('Brand') == "betflix"){
            $data = $this->callPlay("/login/lobby/game","","");
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
                return;
            }else{
                $msg = $this->checkErrorCode($code);
                echo '
                    <script>
                        window.onload = function(){
                            window.close();
                        }
                    </script>
                ';
                return;
            }
        }else if(Session::get('Brand') == "pgslot"){
            $data = $this->callPlay("/".Session::get('Brand')."/play/slot","","");
            // dd($data);
            if(isset($data["code"])){
                $code = $data["code"];
            }else{
                $code = null;
            }
            if($data["code"] == "0"){
                echo '
                    <script>
                        window.onload = function(){
                            window.open("'.$data["url"]. '","_blank");
                            setTimeout(() => {
                                window.close();
                            }, 2000);
                        }
                    </script>
                ';
                return;
            }else{
                $msg = $this->checkErrorCode($code);
                echo '
                    <script>
                        window.onload = function(){
                            window.close();
                        }
                    </script>
                ';
                return;
            }
        }
        return redirect()->back();
    }


    public function callGame($path,$type){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-game')."/askmebet".$path,
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
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);

        $value = array();
        $msg = "";
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

    public function pagePassword()
    {
        // dd("OK");
        return view('passwordChange');
    }

    public function pageActivity()
    {
        // dd("OK");
        return view('activity');
    }

    public function pageCode()
    {
        $data = $this->getHistoryCode();
        // dd($data);
        return view('code')->with("data",$data);
    }

    public function pageDownload()
    {
        return view('download');
    }

    public function pagePredition()
    {
        $data = $this->getPreditionList();
        return view('predition')->with("data",$data);
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
            "Name"=> "",
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

    public function getAffiliate(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/affiliate/summary",
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
        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
    }
    public function getAffiliateCreditSummary(){
        $AccessToken = Session::get('AccessToken');
        // $AccessToken = Cookie::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/affiliate/summary",
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
        $result = json_decode($response, true);
        $result = $result["data"];
        return $result;
    }
    public function requestAffiliate(Request $request){
        $AccessToken = Session::get('AccessToken');
        $payload = null;
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/affiliate/request",
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
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        if(isset($data["code"])){
            if($data["code"] == "0"){
                $message = "success";
            }else{
                $message = "failed";
            }
        }else{
            $message = "failed";
        }

        return redirect()->route('pageAffiliate',"prefix=".Session::get('Prefix'))->with('message',$message);
    }

    public function getBankDeposit(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/bank/deposit",
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
        
        $value = array([
            "Bank"=> "",
            "Bank_Account"=> "",
            "Bank_Name"=> "",
            "Bank_Th"=> ""
        ]);
        if(!empty($data["code"]) == "0" && !empty($data["data"]) != []){
            $value = $data["data"];
        }
        return $value;
    }

    public function getTruewalletDeposit(){
        // $prefix = Session::get('Prefix');
        // $payload = [
        //         "prefix" => $prefix
        // ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/truewallet/deposit",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_POSTFIELDS => json_encode($payload),
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
        
        $value = array([
            "Telephone"=> "",
            "Name"=> "",
        ]);
        if(!empty($data["code"]) == "0" && !empty($data["data"]) != []){
            $value = $data["data"];
        }
        return $value;
    }

    public function withdraw(Request $request){
        $AccessToken = Session::get('AccessToken');
        $payload = [
                "money" => floatval($request->amount)
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/withdraw",
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
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        // dd($data);
        if(isset($data["code"])){
            if($data["code"] == "0"){
                $message = "withdraw_success";
                $code = $data["code"];
            }else{
                $message = $data["message"];
                $code = $data["code"];
            }
        }else{
            $message = "withdraw_failed";
            $code = "806";
        }
        sleep(1);
        // $account = $this->getAccountInfo();
        // $credit = $this->getCredit();
        // dd($message);
        // dd($code);
        return redirect()->route('withdraw',"prefix=".Session::get('Prefix'))->with('message',$message)->with('code',$code);
        // return view('withdraw')->with('message',$message)->with('code',$code)->with("account",$account)->with("credit",$credit->getData()->data);
        // return redirect()->back();
        // return response()->json($data);
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

        if(!empty($data) && $data["code"] == "0"){
            Session::put('Credit', $data["data"]);
            Session::put('CreditTime', time());
        }
        return response()->json($data);
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
        return response()->json($data);
    }

    public function getPromotionList(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/promotion/agent/list",
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
        $result = json_decode($response, true);
        if(!empty($result["data"])){
            $data = $result["data"];
        }else{
            $data = [];
        }
        return $data;
    }

    public function getPromotion(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/promotion/now",
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
        $result = json_decode($response, true);
        // dd($data);
        return $result;
        // return response()->json($data);
    }

    public function promotionRequest($id){
        $AccessToken = Session::get('AccessToken');
        $payload = [
                "PromotionId" => $id
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/promotion/request",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
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
        if(isset($data["code"])){
            if($data["code"] == "0"){
                $message = "success";
                $code = $data["code"];
            }else{
                $message = $data["message"];
                $code = $data["code"];
            }
        }else{
            $message = "promotion_request_failed";
            $code = "806";
        }
        return redirect()->route('promotion',"prefix=".Session::get('Prefix'))->with('message',$message)->with('code',$code);
    }

    public function promotionCancel(){
        $AccessToken = Session::get('AccessToken');
        $payload = [
                "Status" => "0"
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/promotion/cancel",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
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
        if(isset($data["code"])){
            if($data["code"] == "0"){
                $message = "success";
                $code = $data["code"];
            }else{
                $message = $data["message"];
                $code = $data["code"];
            }
        }else{
            $message = "promotion_request_failed";
            $code = "806";
        }
        return redirect()->route('promotion',"prefix=".Session::get('Prefix'))->with('message',$message)->with('code',$code);
    }

    public function passwordChange(Request $request){
        $AccessToken = Session::get('AccessToken');
        $payload = [
            "New_Password" => $request->newPassword,
            "Old_Password" => $request->oldPassword
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/account/change/password",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($payload),
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
        // dd($data);
        if(isset($data["code"])){
            if($data["code"] == "0"){
                $message = "change_success";
            }else if($data["code"] == "809"){
                $message = "change_wrong";
            }else{
                $message = "change_failed";
            }
        }else{
            $message = "change_failed";
        }
        return redirect()->route('pagePassword',"prefix=".Session::get('Prefix'))->with('message',$message);

    }

    public function getWheelPoint(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/wheel/point",
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
        return response()->json($data);
    }

    public function getWheelLast(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/wheel/calculate/last",
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
        return response()->json($data);
    }

    public function getWheelSpin(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/wheel/calculate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
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
        return response()->json($data);
    }

    public function wheelPointDeal(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/wheel/point/deal",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
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
        return response()->json($data);
    }

    public function getWheelHistory($limit,$page){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/wheel/history?limit=".$limit."&page=".$page,
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
        $result = json_decode($response, true);
        $result = $result["data"];
        return $result;
    }

    public function codeDeal(Request $request){
        $AccessToken = Session::get('AccessToken');
        $payload = [
            "code" => $request->code
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/code/request",
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
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        if(isset($data["code"])){
            // dd($data["code"]);
            if($data["code"] == "0"){
                $message = "success";
                $code = $data["code"];
            }else{
                $message = $data["message"];
                $code = $data["code"];
            }
        }else{
            $message = "failed";
            $code = "806";
        }
        return redirect()->back()->with('message',$message)->with('code',$code);

    }

    public function getHistoryCode(){
        $AccessToken = Session::get('AccessToken');
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/code/history?limit=20&page=1",
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
        $result = json_decode($response, true);
        $result = $result["data"];
        $data = $result["data"];
        // dd($data);
        return $data;
    }

    public function predition(Request $request){
        $AccessToken = Session::get('AccessToken');
        $payload = [
                "number" => $request->first . $request->second
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/predition/request",
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
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        if(isset($data["code"])){
            if($data["code"] == "0"){
                $message = "success";
                $code = $data["code"];
            }else{
                $message = $data["message"];
                $code = $data["code"];
            }
        }else{
            $message = "failed";
            $code = "806";
        }
        // dd($code);
        // $data = $this->getPreditionList();
        // return view('predition')->with("data",$data)->with('message',$message)->with('code',$code);
        return redirect()->route('pagePredition',"prefix=".Session::get('Prefix'))->with('message',$message)->with('code',$code);
    }

    public function getPreditionList(){
        $AccessToken = Session::get('AccessToken');
        // $AccessToken = Cookie::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/predition/list?limit=20&page=1",
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
        $result = json_decode($response, true);
        $result = $result["data"];
        $data = $result["data"];

        return $data;
        // dd($data);
        // return view('historyTransfer')->with('data',$data);
        // return response()->json($data);
    }

    public function getTransactions($path){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/history/".$path."?limit=20&page=1",
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
        $result = json_decode($response, true);
        $result = $result["data"];
        $data = $result["data"];
        
        // return view('historyTransfer')->with('data',$data);
        return $data;
    }

    // public function getCashBack(){
    //     $lose = $this->cashBackLoseList();
    //     $win = $this->cashBackWinList();
    //     $summary = $this->cashBackSummary();
    //     $history = $this->cashBackHistory();
    //     return view('cashback')->with('lose',$lose["data"])->with('win',$win["data"])->with('data',$history["data"])->with('summary',$summary["total"])->with('date',$summary["datetime"]);
    // }
    
    public function cashBackLoseList(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/cashback/lose",
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
        $result = json_decode($response, true);

        $data = array([
            "ID" => null,
            "Amount" => 0
        ]);
        if(isset($result["data"])){
            $pagination = $result["data"];
            if(!empty($pagination["data"])){
                $data = $pagination["data"];
            }
        }
        return $data;
    }
    
    public function cashBackWinList(){
        $AccessToken = Session::get('AccessToken');
        // $AccessToken = Cookie::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/cashback/win",
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
        $result = json_decode($response, true);
        $result = $result["data"];
        return $result;
    }
    public function cashBackSummary(){
        $AccessToken = Session::get('AccessToken');
        // $AccessToken = Cookie::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/cashback/summary",
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
        $result = json_decode($response, true);
        $result = $result["data"];
        return $result;
    }
    public function cashBackHistory(){
        $AccessToken = Session::get('AccessToken');
        // $AccessToken = Cookie::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/cashback/history",
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
        $result = json_decode($response, true);
        $result = $result["data"];
        return $result;
    }
    public function requestCashBack(Request $request){
        $AccessToken = Session::get('AccessToken');
        $payload = [
            "id" => intval($request->cashback),
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/transfer/cashback/request",
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
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        if(isset($data["code"])){
            if($data["code"] == "0"){
                $message = "success";
            }else{
                $message = "failed";
            }
        }else{
            $message = "failed";
        }

        return redirect()->back()->with('message',$message);
    }

    public function logout(){
        $prefix = Session::get('Prefix');
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
        return redirect()->route("login","prefix=".$prefix);
    }
    
    // public function test($telephone){
    //     $notification = Notification::where('telephone',$telephone)->where("status","0")->orderBy('id','asc')->first();
    //     if(isset($notification)){
    //         $code = "1";
    //     }else{
    //         $code = "0";
    //     }
    //     return response()->json(["code"=>$code,"data"=>$notification],200);
    //     // dd($notification);
    // }

    public function notifications($telephone)
    {
        // return response()->json(["code"=>"0",$telephone],200);
        $notification = Notification::where('telephone',$telephone)->where("status","0")->orderBy('id','asc')->first();
        if(isset($notification)){
            $code = "1";
        }else{
            $code = "0";
        }
        return response()->json(["code"=>$code,"data"=>$notification],200);
    }

    public function notificationUpdate(Request $request)
    {
        Notification::where("id",$request->id)->update([
            'status' => "1",
        ]);
        return response()->json(["data","success"],200);
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
                "accept: */*",
                "accept-language: th",
                "content-type: application/json",
                'Origin:'.Session::get('Origin'),
                "Authorization: Bearer ".$AccessToken,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        
        $value = [];
        if(isset($data)){
            $value = $data;
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
