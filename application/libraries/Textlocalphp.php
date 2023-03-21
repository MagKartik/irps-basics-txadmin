<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/textlocal/textlocal.class.php';

class TextLocalPhp {
  function send($number, $message)
  {
    $ci = & get_instance();
    $data=array("username"=>'kanaysam123@gmail.com',"hash"=>'d9d1226e4922417ade7a5214f1168c859464f6e45a35228b77f96964e061dc42','apikey'=>'Tdq5AyeP4AU-nuLT51lidZTLz1Rxr0SOeihO9Iy5uN');
    $sender  = "sportblaze";
    $numbers = array($number);
    $ci->load->library('textlocal',$data);
    $response = $ci->textlocal->sendSms($numbers, $message, $sender);
  return $response;
  }
}