<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'assets/cloudinary/src/Cloudinary.php';
require_once 'assets/cloudinary/src/Uploader.php';
require_once 'assets/cloudinary/src/Api.php';
class CloudinaryPhp
{

    public function __construct()
    {
        Cloudinary::config(array(
            "cloud_name" => "dganesh-info",
            "api_key" => "147369713629438",
            "api_secret" => "lt3cWSbStkz7sugs-fnQTAC4meI",
        ));
    }
}
