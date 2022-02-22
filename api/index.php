<?php
require_once __DIR__.'/config.php';
class API extends Dbh{
    protected $url;
    public $responseCode = 200;
    // protected $name;
    // protected $name2;
    public function __construct($url = ''){
        $domain = "";
        // var_dump($_SERVER['HTTP_REFERER']);
        if(isset($_SERVER['HTTP_REFERER'])){
            $domain = explode('/', $_SERVER['HTTP_REFERER']);
            $domain = $domain[0]."/".$domain[1]."/".$domain[2].'/';
            
        }
        if (isset($_GET['url']) && ($domain == $url || $_SERVER['HTTP_HOST'] === 'localhost')) {
                # code...
                $url = trim($_GET['url']);
                $this->url = $url;
            }
            else{
                $this->url = "$";
            }
            
            if($domain != $url && $_SERVER['HTTP_HOST'] !== 'localhost'){
                $this->url = $domain;
                
            }
            
            // $this->name = $name;
        }
    protected function addRequest(){
        try{

            $sql = 'SELECT * FROM websites WHERE website_domain = ? AND verify = ?;';  
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->url, 1]);
        // if(!$stmt->execute([$this->url, 1])){}
        $output = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            if (intval($output['request_made']) < intval($output['request_total'])) {
                $stmt = $this->connect()->prepare('UPDATE websites SET request_made = ? WHERE website_domain = ?;');
                $stmt->execute([$output['request_made'] + 1, $this->url]);
                return true;
            }
            else{
                return false;
            }
        }
    }
        catch(Exception $e){
            $this->responseCode = 400;
            echo json_encode([$e, "responseCode" => $this->responseCode]);
            exit;
        }
        
    }
    public function getWebsiteDetails(){
        try{

            
            
        if (isset($_GET)){
            $sql = 'SELECT * FROM websites WHERE website_domain =  ? AND verify = ?;';  
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->url, 1]);
            
        }
        else{
            return false;
        }
        $user = array();
        $user['requestUrl'] = $this->url;
        $output = $stmt->fetch();
        
        $this->responseCode = 400;
        if ($stmt->rowCount() > 0) {
            $this->responseCode = 200;
            if ($this->addRequest()) {
                $this->responseCode = 200;
                # code...
            

            
            $n=0;
            // $user['param']['website_domain'] = $this->age;
            $user['status'] = true;
            $user['data'] = null;
            $user['error'] = null;
            
            $user['data'] = array(
                'website_domain' => $output['website_domain'],
                'website_tld' => $output['website_TLD'],
                'website_currency' => $output['website_currency']
            );
            $request_percent = ($output['request_made'] / $output['request_total']) * 100;
            
            if($request_percent >= 80 && $request_percent <= 89){
                $user['message'] = "You have exceeded more than 80% of your total request";
            }
            elseif($request_percent >= 90){
                $user['message'] = "You have exceeded more than 90% of your total request";
                
            }
            else{
                
                $user['message'] = "Thanks for using Currencynet";
            }
            $user['responseCode'] = $this->responseCode; 
        }
        else{
            $user['status'] = true;
            $user['data'] = null;
            $user['error'] = "request exceeded";
            $user['message'] = "Login into https://".$_SERVER['HTTP_HOST']." to buy more request";
            $this->responseCode = 300;
            $user['responseCode'] = $this->responseCode; 
        }
        }
        else{
            $this->responseCode = 400;

            $user['status'] = false;
            $user['data'] = null;
            $user['error'] = "website not registered"; 
            $user['responseCode'] = $this->responseCode; 
            
            
            
        }
        return json_encode($user);
    }
    catch (\Exception $e){
        
        $this->responseCode = 400;
        return json_encode([$e, "responseCode" => $this->responseCode, "requestUrl" => $this->url]);

    }
        
    }
}
$url = '';
if(isset($_GET['url'])){
    $url = $_GET['url'];
}
$API = new API($url);   
// header('Content-Type: application/json');
// var_dump($_SERVER);
echo $API->getWebsiteDetails();
// echo $API->responseCode;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json', true, $API->responseCode);

?>