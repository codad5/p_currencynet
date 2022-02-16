<?php
  $url = "https://api.paystack.co/transaction/initialize";
  $fields = [
    'email' => "cutomer@email.com",
    'amount' => "20000",
  ];
  $fields_string = http_build_query($fields);
  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer sk_live_620ccbfed94458dc565bf388bdbfefaed5111397",
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
  echo $result;
  $err = curl_error($ch);
  curl_close($ch);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $readAble = json_decode($result, true);
    var_dump( $readAble);
  }
?>