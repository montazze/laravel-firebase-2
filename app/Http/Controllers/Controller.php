<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    protected $client;
    const DEFAULT_URL = 'https://myproject-f2f21.firebaseio.com';
    const DEFAULT_TOKEN = '47y7d6aXY3Q92SidXL78vwhcv403E62pqCsI78I4';
    const DEFAULT_PATH = '/database/my_laravel';
    protected $firebase;
    public function initialize()
    {
        \Predis\Autoloader::register();
    }
    
     public function __construct(Request $request) {
         $this->initialize();
        $this->page = $request->get('page');
        if(!$this->page){
            $this->page = 1;
        }
        $this->limit = $request->get('limit');
        if(!$this->limit){
            $this->limit = 20;
        }
        $this->method = $request->getMethod();
        if (in_array($this->method, ['PUT'])) {
            $content = $request->getContent();
            $this->post_data = json_decode($content, true);
        }
         $this->client = new \Predis\Client();
         $this->firebase = new \Firebase\FirebaseLib(self::DEFAULT_URL, self::DEFAULT_TOKEN);
     }
		
}
