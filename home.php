<?php
session_start();
if(!isset($_SESSION['account_holder'])){
    header('location: index ');
    exit;
}
// echo $_SESSION['account_holder'];
 $html = file_get_contents('http://localhost/Api-test/index.html');
 $tags = get_meta_tags('http://localhost/Api-test/index.html');
//  var_dump($tags);
 include "classes/Dbh.classes.php";
 include "classes/user.class.php";
 $user = new User($_SESSION['account_holder']);
 include_once 'header.php';
 ?>
 <?php 
    $user->CheckAllPayment();
  ?>
<script>
  

</script>

    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
      <!-- <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li> -->
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#e2cb2b"/></svg>

        <div class="container">
          <div class="carousel-caption">
            <h1><span style='color:#8a2be2'>Bootstrap</span> For Currency </h1>
            <p>Give your customers satisfaction and confidence when trading with you in your website</p>
            <p>  <code class='code'><script src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/currencynet/scripts/currencynet.v2.min.js" ></script></code> </p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#7d7d7d"/></svg>

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Easy to use</h1>
            <p>We easily convert your currency on your website by using our <var>className(s)</var> and <var>data vaue</var> for any element your which to covert</p>
            <p><code style="background:#fff;">eg: <span class="currencynet-init" data-currencynet-value='100'> </span></code> </p>
            <p><samp>output : <span class="currencynet-init" data-currencynet-value='100'> </span></samp> </p>
            <p><code style="background:#fff;">eg: <span class="currencynet-init-ngn" data-currencynet-value='345'> </span></code> </p>
            <p><samp>output : <span class="currencynet-init-ngn" data-currencynet-value='345'> </span></samp> </p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
          </div>
        </div>
      </div>
      <!-- <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#e2cb2b"/></svg>

        <div class="container">
          <div class="carousel-caption">
            <h1><span style='color:#8a2be2'>Bootstrap</span> For Currency </h1>
            <p>Give your customers satisfaction and confidence when trading with you in your website</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
          </div>
        </div>
      </div> -->
      <!-- <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
          </div>
        </div>
      </div> -->
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>

  <section  class="container" >

      <form action="inc/add.inc.php" method="post" class='add-webiste-form'>
          <div class="input-group mb-3 row">
             
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon3">https://example.com</span>
        <input type="url"  class="form-control" id="webiste_url" aria-describedby="basic-addon3" name="url" placeholder="Enter your website" value="https://example.com">
    </div>
</div>
<!-- <input class="form-control form-control-lg" id="webiste_url" name="url" placeholder="Enter your website"> -->

    
    <div class="input-group mb-3 row">
    <div class="input-group mb-3">

        <label class="input-group-text" for="default_currency">currency</label>
        <select name="default_currency form-select" aria-label=".form-select-lg example" aria-describedby="basic-addon3" id="default_currency">
            
            
            </select>
    </div>
        </div> 
        <div class="mb-3 row input-group mb-3"">
            <label for="" class="col-sm-2 form-label text-center"></label>
            <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
        </div>
        
        <div id="meta-code"></div>
        
    </form>
</section>
    <section class="myPropTable" style="overflow-x:scroll !important;">
        
        <?php include_once 'inc/table.inc.php';?>
    </section>
    <section  class="container" ></section>
   



    
  <?php include_once 'footer.php'; ?>
    
    
</main>
</body>
<script src="https://js.paystack.co/v1/inline.js"></script> 
<script>
    let website_input = document.getElementById("webiste_url");
    let requestAmountInput = document.getElementById("requestAmount");
    let meta_tag = document.getElementById("meta-code");
    var code = "<?php echo str_split(uniqid(), 4)[2]; ?>" + new Date().valueOf() +
        "<?php echo str_split(uniqid(), 4)[2]; ?>";
    website_input.addEventListener("input", () => {
        code = "<?php echo str_split(uniqid(), 4)[2]; ?>" + new Date().valueOf() +
            "<?php echo str_split(uniqid(), 4)[2]; ?>";
        meta_tag.innerText = `input this code to your website :: <meta name="currencynet" content="${code}">`;
    });
    $(document).ready(function () {
        $(".add-webiste-form").submit(function (event) {
            event.preventDefault();
            let website = $("#webiste_url").val();
            let default_currency = document.querySelector("#default_currency").value ?? "usd";
            



            $(".myPropTable").load("inc/verifywebsite.inc.php", {
                website: website,
                default_currency: default_currency,
                code: code

            });
        });
        
    });

    const animeCss = document.querySelectorAll('.animate__animated');
    animeCss.forEach(element => {
        element.addEventListener('animationend', () => {
            // do something
            setTimeout(() => {
                element.style.display = 'none';

            }, 3000)
        });
    });
    let codeBlock = document.querySelectorAll('code');
          // console.log(codeBlock);
          Array.prototype.forEach.call(codeBlock, element => {
            let preText = element.innerHTML;
            // console.log(preText);
            element.innerText = preText;
          })
</script>
<script src="scripts/work.min.js"></script>

</html>