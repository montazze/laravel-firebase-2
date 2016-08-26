<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logging;
use Illuminate\Support\Facades\Redis;
use Validator;

class HomeController extends Controller
{
    public function index()
    {
        //test redis cache
        // $value = $this->client->get('url-site');
        // echo "<pre>";
        // print_r($value = $value);
        // $this->client->del('url-site');
        // exit();
        
    }
}