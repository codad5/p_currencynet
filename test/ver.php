<?php
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/z2195e2opv",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_live_620ccbfed94458dc565bf388bdbfefaed5111397",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  
  $readAble = json_decode($response, true);
                var_dump( $readAble);
                
?>