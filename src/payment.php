<?php

namespace cardify;

require('vendor/autoload.php');

use Env\Getkeys;

class Payment {
    
    private $PBFPubKey;
    private $SEC_KEY;
    private $data;
    private $ENC_KEY;
    private $url;

    public function __construct() {
        $env = new Getkeys();
        $this->SEC_KEY = $env->env('SEC_KEY');
        $this->PBFPubKey = $env->env('PBFPubKey');
        $this->ENC_KEY = $env->env('ENC_KEY');
        $this->url = $env->env('ENDPOINT_URL');
    }

    private function getKey($seckey){
        $hashedkey = md5($seckey);
        $hashedkeylast12 = substr($hashedkey, -12);
      
        $seckeyadjusted = str_replace("FLWSECK-", "", $seckey);
        $seckeyadjustedfirst12 = substr($seckeyadjusted, 0, 12);
      
        $encryptionkey = $seckeyadjustedfirst12.$hashedkeylast12;
        return $encryptionkey;
      
    }
    
    
    private function encrypt3Des($data, $key){

        $encData = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);
        return base64_encode($encData); 
    
    }  
    
    public function cardPaymet($data){

        $reqStri = $this->encrypt3Des($data, $this->ENC_KEY);

        $details=[
            'PBFPubKey' => $this->PBFPubKey,
            'client' => $reqStri
        ];

        $body = json_encode($details);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/charges?type=card",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $this->SEC_KEY"
            ),
        ));

        $response = curl_exec($curl);
    
        curl_close($curl);
        return $response;
    }

    public function ussdPayment($data){
        $details = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/charges?charges?type=ussd",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $details,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $this->SEC_KEY"
            ),
        ));

        $response = curl_exec($curl);
    
        curl_close($curl);
        return $response;

    }
    
    public function accountPayment($data){

        $details = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/charges?type=debit_ng_account",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $details,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $this->SEC_KEY"
            ),
        ));

        $response = curl_exec($curl);
    
        curl_close($curl);
        return $response;
    }

    public function postOTP($data){

        $details = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/validate-charge",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $details,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $this->SEC_KEY"
            ),
        ));

        $response = curl_exec($curl);
    
        curl_close($curl);
        return $response;
    }
}