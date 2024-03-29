<?php
// session_start();

use function PHPSTORM_META\type;

    class User extends Dbh{
        public $mail;
        public $data ;
        public $rate = 1;
        private $secretKey = "sk_live_620ccbfed94458dc565bf388bdbfefaed5111397";
        public function __construct($mail) {
            $this->mail = $mail;
            $this->data = $this->checkUser($this->mail);
            if (!$this->checkUser($this->mail)){
                // echo "hello";
                session_unset();
                session_destroy();
                header('location:../?error=uidtaken');
            }
            

        }
        
        public function addWebsite($url, $currency = 'usd'){
            if ($this->checkWebsite($url) === false) {
                // echo "hello";
                $tld = explode('.', $url);
                $tld = $tld[count($tld) - 1];
                // $tld = explode('/', $tld);
                // $tld = $tld[0];
                $verify = true;
                $stmt = $this->connect()->prepare('INSERT INTO websites (website_domain , website_TLD , website_owner, website_currency, request_total, verify) VALUES (?, ?, ?,?,?,?);');
            
                if (!$stmt->execute(array($url,$tld, $this->mail, $currency, 1000,  $verify))) {
                    $stmt = null;
                    return false;
                    exit();
                }
        
                return true;
                exit();
                // $this->signUp();
                
            } elseif($this->checkWebsite($url)[0]['verify'] < 1){
                $this->reActivateWebsite($url, $currency);
                return true;
                exit();
              
            }else {
                return 11;
                exit();
            }
        }

        public function getWebsites(){
            $stmt = $this->connect()->prepare("SELECT * FROM websites WHERE website_owner = ? AND verify = ?;");
            if(!$stmt->execute(array($this->mail, 1))){
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();

            }
            // return $stmt->rowCount();
            if($stmt->rowCount() > 0){
                
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            }
            else{
                return true;
            }
            
        

    
        }
        public function addRequest($requestAmount, $website, $ref){
            $newAmount = $requestAmount + 10;
            
                if($this->checkWebsite($website) != 7){
                    // echo $this->checkWebsite($website);
                    $totalrequest = $this->checkWebsite($website)[0]['request_total'];
                    $newAmount = $totalrequest + $requestAmount;
                }

                $sql = "UPDATE websites SET request_total = ? WHERE website_domain = ?;";
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute([$newAmount, $website])){
                     $stmt = null;
                    return false;
                    exit();
                
                }
                $website_new_details = $this->checkWebsite($website)[0];
                echo "<script>
                        notificationAdd('Adding Request for ".$ref."', 'alert-danger');
                     </script>";
                

                if($website_new_details['request_total'] == $newAmount){
                    
                    $sql = "UPDATE request_orders SET verify = ? WHERE refrence_key = ?;";
                    $stmt = $this->connect()->prepare($sql);

                    if(!$stmt->execute([true, $ref])){
                        $stmt = null;
                        return false;
                        exit();
                    }
                    
                    return true;
                }
                
                return true;

        }
        public function trashWebsite($website, $currency = 'usd') {
            if($this->checkWebsite($website) != 7){
                    // echo $this->checkWebsite($website);
                $sql = "UPDATE websites SET verify = ? ,request_total = ? , request_made = ? WHERE website_domain = ? AND website_owner = ?;";
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute([0,  0, 0, $website, $this->mail])){
                    $stmt = null;
                    return false;
                    exit();
                }
                else{
                    return true;

                }
                
                
                    
                }

                
                
        }
        public function reActivateWebsite($website, $currency = 'usd') {
            if($this->checkWebsite($website) != 7){
                    // echo $this->checkWebsite($website);
                $mail = $this->checkWebsite($website)[0]['website_owner'];
                $sql = "UPDATE websites SET verify = ? , website_currency = ? ,  request_total = ? , website_owner = ? WHERE website_domain = ?;";
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute([1, $currency, 0, $this->mail, $website])){
                    $stmt = null;
                    return false;
                    exit();
                }
                else{
                    return true;

                }
                
                
                    
                }

                
                
        }
        public function saveOrder($readAble, $domain, $rate, $amount){
            
            $readAble = $readAble['data'];
   
            $stmt = $this->connect()->prepare('INSERT INTO request_orders (email , website_domain , refrence_key, authorization_url, access_code,rate,amount, verify) VALUES (?, ?, ?,?,?,?,?,?);');
            
                if (!$stmt->execute(array($this->mail, $domain, $readAble['reference'], $readAble['authorization_url'], $readAble['access_code'],$rate, $amount,  false))) {
                    $stmt = null;
                    return false;
                    exit();
                }
                
        
                return true;
                
            

        }
        public function prePayment(int $amount = 0, $domain){
            $rate = $this->rate;
            
            $url = "https://api.paystack.co/transaction/initialize";
            $fields = [
                'email' => $this->mail,
                'amount' => $amount * $rate * 100,
            ];
            $fields_string = http_build_query($fields);
            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer ".$this->secretKey,
                "Cache-Control: no-cache",
            ));
            
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
            
            //execute post
            $result = curl_exec($ch);
            // echo $result;
            $err = curl_error($ch);
            curl_close($ch);
            
            if ($err) {
                echo "<script>
                        notificationAdd(' Could not connect to paystack cURL Error #: ".$err."', 'alert-danger');
                     </script>";
                
                
                return false;
                exit();
            } else {
                $readAble = json_decode($result, true);
                // var_dump( $readAble);
                if($readAble['status']){
                    if($this->saveOrder($readAble, $domain, $rate, $amount)){

                        return $readAble;
                    }
                    else{
                        return false;
                    }
                    
                }
            }
            
            
        }
        public function verifyPayment($refrence){
            if($this->getPayment($refrence) === false){
                echo "<script>
                        notificationAdd('Such payment Record fail to Exists for ".$refrence."', 'alert-warning');
                     </script>";
                
                            return ["norm"];
                            // exit;
            }
            if($this->getPayment($refrence)[0]['verify'] != 0){
                echo "<script>
                        notificationAdd('Payment Already Added', 'alert-info');
                     </script>";
                
                            // exit;
                            return ["norm"];
            }
            
            
            $curl = curl_init();
            // $refrence = "ipa6q91vl5";
  
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$refrence,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer ".$this->secretKey,
                    "Cache-Control: no-cache",
                    ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                
                if ($err) {
                     echo "<script>
                            notificationAdd('CVerification  cURL Error #   :".$err."' , 'alert-danger');
                        </script>";
                
                    
                } else {
                    $readAble = json_decode($response, true);
                    // var_dump( $readAble);success
                    if($readAble['status'] === true){
                    if($readAble['data']['status'] === 'success'){
                        $getPayment = $this->getPayment($readAble['data']['reference']);
                        $getPayment = $getPayment[0];
                        if($getPayment !== false){

                            // return $readAble;
                            if($this->addRequest($getPayment['amount'], $getPayment['website_domain'], $readAble['data']['reference'])){
                                echo "<script>
                                        notificationAdd('Verification  cURL Error #   :".$readAble['data']['reference']."' , 'alert-danger');
                                    </script>";
                                
                                return true;
                            }
                            else{
                                return false;
                            }
                            
                        }
                        else{
                            return false;
                        }
                        
                    }
                    else{
                        echo "<script>
                                notificationAdd('Payment with reference id #  :".$readAble['data']['reference']." was ".$readAble['data']['status']."' , 'alert-warning');
                            </script>";
                        
                        return 'false';
                    }
                    }
                    else{
                        echo "<script>
                                notificationAdd('Payment with reference id #  :".$refrence." was did not go through' , 'alert-warning');
                            </script>";
                        
                        return 'false';
                    }
                }

        }
        protected function getMyPayment($vaild = null){
            if($vaild){
                
                $stmt = $this->connect()->prepare("SELECT * FROM request_orders WHERE email  = ? AND verify = ?;");
                $passedStmt = $stmt->execute(array($this->mail, 1));
            }
            elseif ($vaild === false) {
                # code...
                $stmt = $this->connect()->prepare("SELECT * FROM request_orders WHERE email  = ? AND verify = ?;");
                $passedStmt = $stmt->execute(array($this->mail, 0));
            }
            else{
                $stmt = $this->connect()->prepare("SELECT * FROM request_orders WHERE email  = ?;");
                $passedStmt = $stmt->execute(array($this->mail));
            }
            if(!$passedStmt){
                $stmt = null;
                return false;

            }
            // return $stmt->rowCount();
            if($stmt->rowCount() < 1){
                // echo $stmt->rowCount();
                return  false; #$stmt->rowCount();
                
            }
            else{
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                // return false;
            }
        

        }
        public function CheckAllPayment(){
            $payments = $this->getMyPayment(false);
            try{

            
            if(count($payments) > 0){

            
            foreach ($payments as $key) {
                if($key['verify'] == false){
                    if($this->verifyPayment($key['refrence_key'])){

                        echo "<script>
                                notificationAdd(' Trying to Verify Payment with Refrence Key:  :".$key['refrence_key']." was did not go through' , 'alert-warning');
                            </script>";
                    }
                }
                # code...
            }
        }
        }catch(TypeError $e){
            // echo "Error: " . $e->getMessage;
            echo "<script>
                                notificationAdd('NO' , 'alert-warning');
                            </script>";
        }
    }

    }