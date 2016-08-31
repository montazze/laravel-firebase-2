<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logging;
use Illuminate\Support\Facades\Redis;
use Validator;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        echo '123'; die;
         //$value = $this->client->get('url-site');
         //echo "<pre>";
         //print_r($value = $value);
         //$this->client->del('url-site');
        // exit();
        // $test = array(
        //     "foo" => "bar",
        //     "i_love" => "lamp",
        //     "id" => 42
        // );
        // $dateTime = new \DateTime();
        // $this->firebase->set(self::DEFAULT_PATH . '/' . $dateTime->format('c'), $test);
        
        // // --- storing a string ---
        // $this->firebase->set(self::DEFAULT_PATH . '/name/contact001', "John Doe");
        
        // // --- reading the stored string ---
        // $name = $this->firebase->get(self::DEFAULT_PATH . '/name/contact001');
        // print($name);
        // exit();
    }
}