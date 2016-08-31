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
    const RESP_OK = "RESP_OK";
    const RESP_FAIL = "RESP_FAIL";
    protected $firebase;
    protected $apiKey = 'AIzaSyBR_JPR3YYIdjq-UygC0Ask6Q9xvJJ1CJI';//define api Key no google cloud message
    protected $url = 'https://fcm.googleapis.com/fcm/send'; // define url project
    protected $ipaddress;
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
         $this->ipaddress = $this->get_client_ip_env();
     }
    /**
     * Assign value to arr if not null
     *
     * @return the arr after assigning
     */
    protected function assignIfNotNull(&$arr, $key, $value)
    {
        if (!is_null($value)) {
            $arr[$key] = $value;
            return TRUE;
        }
        return FALSE;
    }
    
    // setResponse
    
    protected function setResponse($type, $data)
    {
        return array('responseType' => $type, 'data' => $data, 'server_time' => date("Y-m-d H:i:s"));
    }
    
    // random String for URL 
    
    protected function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
       protected function utf8_urldecode($str)
    {
        return html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str)), null, 'UTF-8');
    }

    public function sendGoogleCloudMessage($data)
    {
        $data["content_available"] = true;
        $data['priority'] = 'high';
        $data["notification"]["title"] = "MY PROJECT";
        $data["notification"]["badge"] = "1";
        $data["notification"]["sound"] = "default";
        $data["notification"]["type"] = 1;
        $headers = array(
            'Authorization: key=' . $this->apiKey,
            'Content-Type: application/json'
        );

        // Initialize curl handle
        $ch = curl_init();

        // Set URL to GCM endpoint
        curl_setopt($ch, CURLOPT_URL, $this->url);

        // Set request method to POST
        curl_setopt($ch, CURLOPT_POST, true);

        // Set our custom headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Get the response back as string instead of printing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set JSON post data
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Actually send the push
        $result = curl_exec($ch);

        // Error handling
        if (curl_errno($ch)) {
            echo 'GCM error: ' . curl_error($ch);
        }
        // Close curl handle
        curl_close($ch);
    }
    protected function get_client_ip_env()
    {
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    protected function getLocalesByCountry($key = '')
    {
        $data = array
        (
            'VN' => 'vi',
            'US' => 'en',
            'SG' => 'en',
            'MY' => 'en',
            'CN' => 'zh',
            'HK' => 'zh',
            'MO' => 'zh',
        );
        if (array_key_exists($key, $data)) {
            return $data[$key];
        } else {
            return 'en';
        }
    }
        public function checkUserAgent($type = NULL)
    {
        $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if ($type == 'bot') {
            if (preg_match("/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent)) {
                return true;
            }
        } else if ($type == 'browser') {
            // matches core browser types
            if (preg_match("/mozilla\/|opera\//", $user_agent)) {
                return true;
            }
        } else if ($type == 'mobile') {
            if (preg_match("/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent)) {
                return true;
            } else if (preg_match("/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent)) {
                return true;
            }
        }
        return false;
    }
    protected function returnExistFileType($type)
    {
        $typeArray = array(
            'img' => array(
                'image/png',
                'image/jpg',
                'image/jpeg',
                'image/gif',
                'image/bmp'
            )
        );

        foreach ($typeArray as $key => $value) {
            if (in_array($type, $value)) {
                return $key;
            }
        }

        return null;
    }

    protected function returnExistFileOffice($type)
    {
        $response = NULL;
        switch ($type) {
            case 'application/msword':
                $response = true;
                break;
            case 'application/doc':
                $response = true;
                break;
            case 'application/x-pdf':
                $response = true;
                break;
            case 'application/rtf':
                $response = true;
                break;
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                $response = true;
                break;
            case 'application/pdf':
                $response = true;
                break;
        }
        return $response;
    }
}
