<?php

namespace cardify;
require('vendor/autoload.php');

use Env\Getkeys;

class Slamifyer
{
    private $SEC_KEY;
    private $url;
   
    public function __construct() {
    $env= new Getkeys();
    $this->SEC_KEY= $env->env('SEC_KEY');
    $this->url= $env->env('ENDPOINT_URL');
    }

   public function getBanks($country='NG' ){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "$this->url/banks/$country",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $this->SEC_KEY"
        ),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
        return json_decode($response);
    
   }

   public function getAccount($account_number, $account_bank){
        $banks=$this->getBanks('NG')->data;


        if(is_numeric($account_bank)){
            $bank_code=$account_bank;
            
        }else{
            foreach ($banks as $bank) {
        
                if(stristr($bank->name, $account_bank)){
                    $bank_code=$bank->code;  
                }

            }
        }

        $details=[
        'account_number'=>$account_number,
        'account_bank'=> '057'
        ];

        $body=json_encode($details);
        $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$this->url/accounts/resolve",
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
                    "Authorization: Bearer ".$this->SEC_KEY
                ),
            ));
            
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
    }

    public function getCardbin($bin){
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "$this->url/card-bins/$bin",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $this->SEC_KEY"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function get_bvn($bvn){


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/kyc/bvns/$bvn",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $this->SEC_KEY"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

}





?>