<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class LoadPrefix
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('Prefix')){
        // if(config('app.prefix') != "#"){
            // dd($request);
            return $next($request);
            // return redirect($request->getPathInfo()."?prefix=".Session::get('Prefix'));
        }else if($request->has("prefix")){
            $resp = $this->loadAgentPrefix($request->prefix);
            if(!empty($resp) && $resp["code"] == "0"){
                $data = $resp["data"];
                Session::put('Origin', $data["Prefix"]);
                config()->set('app.origin',$data["Prefix"]);
                config()->set('app.prefix',$data["Prefix"]);
                // Session::put('Prefix', $data["Prefix"]);
                config()->set('app.agent',$data["Agent"]);
                config()->set('app.brand',$data["Brand"]);
                config()->set('app.color-theme',$data["Color"]);
                config()->set('app.owner',$data["Owner"]);
                config()->set('app.logo',$data["Logo"]);
                $base64 = $this->imageBase64($data["Logo"]);
                config()->set('app.logo-base64',$base64);
                config()->set('app.background',$data["Background"]);
                config()->set('app.line',$data["LineOA"]);
                return $next($request);
            }
        }
        return response()->view('page404');
        
        // if(!empty(Session::get('Brand'))){
        //     if(Session::get('Brand') == "askmebet"){
        //         $brand = "ambbet";
        //     }else{
        //         $brand = Session::get('Brand');
        //     }
        // }else{
        //     $brand = "ambbet";
        // }
        // if($request->session()->has('ThemeTime') || ($brand != request()->segment(2))){
        //     $theme = Session::get('Theme');
        //     $ThemeTime = Session::get('ThemeTime');
        //     if((time()-$ThemeTime) > 120) {
        //         $theme = $this->getTheme();
        //         Session::put('Theme', $theme);
        //         Session::put('ThemeTime', time());
        //     }else{
        //         if($brand != request()->segment(2)){
        //             $theme = $this->getTheme();
        //             Session::put('Theme', $theme);
        //             Session::put('ThemeTime', time());
        //         }else{
        //             $this->setTheme($theme);
        //         }
        //     }
        //     if(request()->segment(2) == "ambbet"){
        //         $brand = "askmebet";
        //     }else{
        //         $brand = request()->segment(2);
        //     }
        //     // Session::put('Brand', $brand);
        //     return $next($request);
        // }else{
        //     $theme = $this->getTheme();
        //     Session::put('Theme', $theme);
        //     Session::put('ThemeTime', time());
        //     return $next($request);
        // }
        // return abort(404);
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

    public function getTheme(){
        $theme = "blue";
        $resp = $this->loadAgentPrefix(request()->segment(1));
        if(!empty($resp) && $resp["code"] == "0"){
            $data = $resp["data"];
            $theme = $data["Color"];
            config()->set('app.prefix',$data["Prefix"]);
            $this->setTheme($theme);
        }
        return $theme;
    }

    public function setTheme($theme){
        if($theme == "blue"){
            config()->set('app.bg','bg-blue3.jpeg');
            config()->set('app.bg-navbar-top','#023e8e !important');
            config()->set('app.bg-footer','linear-gradient(to left bottom,#0149be,#0463cc,#053d9a,#02457e,#01254d)');
            config()->set('app.bg-menu','#0091ff !important');
            config()->set('app.bg-menu-border','2px solid hsl(213deg 95% 45%) !important');
            config()->set('app.bg-card','#021e6d');
            config()->set('app.bg-theme','#0076cf !important');
            config()->set('app.color-theme','rgb(255 255 255) !important');
            config()->set('app.bottom-nav','linear-gradient(to left bottom,#0061ff,#0463cc,#033c9a,#03579f,#0079ff)');
            config()->set('app.menu-left-btn','linear-gradient(to left bottom,#0062ff,#026fe8,#0545af,#077adc,#037aff)');
        }
    }
    
    public function loadAgentPrefix($prefix){
        // dd($AccessToken);
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
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
    }
}
