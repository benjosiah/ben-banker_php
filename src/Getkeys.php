<?php
namespace Env;
require_once realpath(__DIR__. '/../vendor/autoload.php');
use Dotenv\Dotenv;

class Getkeys{
    
   public function __construct() {
       
   }

    function env($name)
    {
        $dotenv=Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $key=$_SERVER[$name];
        return $key;

    }

}





