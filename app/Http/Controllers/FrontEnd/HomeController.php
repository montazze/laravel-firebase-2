<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logging;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;
use Validator;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        return \View::make("home/index");
    }
}