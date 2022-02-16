<?php
session_start();
      include_once 'header.php';
    ?>

     <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
      <!-- <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li> -->
      <!-- <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li> -->
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#3f4ad1"/></svg>

        <div class="container">
          
            <div class="carousel-caption text-start">
              <h1>Documentation</h1>
              
            
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Begin</a></p>
          </div>
        </div>
        
      </div>
      </div>
</div>
<article class='doc-block'>
  <h2>Import Currencynet</h2>
  <p>code : <code>
            <script src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/currencynet/scripts/test.js" ></script>
          </code></p>
</article>
<article class='doc-block'>
  <h2>Initialize Currencynet </h2>
  <p>Initialize Currencynet for a particular Element using the currency net initialization className(s)</p>
  <p>code : <code>
            <span class="currencynet-init"></span>
          </code></p>
</article>
<article class='doc-block'>
  <h2>Declare your build Value </h2>
  <p>Declare your build Value for a particular Element .
  </p>
  <p>code : <code>
            <span class="currencynet-init" data-currencynet-value='345'></span>
          </code>
          <code>output:</code> <span class="currencynet-init" data-currencynet-value='345'></span>
        </p>
          
          <p>     <strong style="color:#3F4AD1;">Note: This will use your build currency as it's default currency <br>
                  To change this your wil need to initialize the currency with the <em><a href="#country_table" style="text-decoration:underline;">country currency code<a></em></strong>
        </p>
        <p>code example for an India currency Value: <code>
            <span class="currencynet-init-inr" data-currencynet-value='345'></span>
          </code>
          <code>output:</code> <span class="currencynet-init-inr" data-currencynet-value='345'></span><p>
          <a href="#country_table" style="text-decoration:underline;">See all country currency code class<a></em><p>
        </p>
</article>
<article class='doc-block'>
  
  <h2>Setting your own client currency based input or select option</h2>
  <p>code : <code>
      <select id="currency-option" onchange="changeCurrency">
          <option name="USD" id="">USD</option>
          <option name="NGN" id="">NGN</option>
          <option name="EUR" id="">EUR</option>
          <option name="INR" id="">INR</option>
      </select>
      <script>
        document.getElementById('currency-option').addEventListener('change', () => {

          const currencyChanger = new currencynet(false);
          currencyChanger.clientCurrency = document.getElementById('currency-option').value; // this will return the value of the selected currency option  
          currencyChanger.reWrite(true); 
          
        });
      </script>
          </code></p>
           <p>     Note: The false in "<code>... new currencynet(false)</code>" Makes all float return as an Interger
                  
        </p>
  <p>
    output: 
    <p >
        <select  id="currency-option" onchange="changeMoneyValue()">
            <option name="USD" id="">USD</option>
            <option name="NGN" id="">NGN</option>
            <option name="EUR" id="">EUR</option>
            <option name="INR" id="">INR</option>

        </option>
        </select>
        <script>
            let changeMoneyValue = () => {

            let currencyChanger = new currencynet();// the false will make all currency return as an in if true will return as a float
            currencyChanger.clientCurrency = document.getElementById('currency-option').value; // this will return the value of the selected currency option
            currencyChanger.reWrite(true);
            
            };
        </script>
    </p>
    <p>code : <code>
            <span class="currencynet-init" data-currencynet-value='345'></span>
          </code>
          <code>output:</code> <span class="currencynet-init" data-currencynet-value='345'></span>
        </p>
  </p>
</article>
      
      <div class="table-con" style="width:100%;overflow-y:scroll;padding:100px 0;">

    <table class="table table-striped table-hover table-responsive">
      
        <thead>
            <tr>
                <th>Country</th>
            <th>ISO_3_CODE</th>
            <th>ClassName</th>
            
            
        </tr>
        
    </thead>
    
    <tbody id="country_table">
      
      <tr>
      <td>Your Build Country</td>
      <td></td>
      <td>currencynet-init</td></tr>
    </tbody>

    <script src="scripts/work2.min.js">
         
    </script>
    <script>
      let codeBlock = document.querySelectorAll('code');
          // console.log(codeBlock);
          Array.prototype.forEach.call(codeBlock, element => {
            let preText = element.innerHTML;
            // console.log(preText);
            element.innerText = preText;
          })
    </script>