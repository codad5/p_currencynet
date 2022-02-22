<?php
session_start();
    if(isset($_SESSION['account_holder'])){
        header('location:home');
        // echo 'me';
        
      }
      include_once 'header.php';
    ?><?php 
    
        if(isset($_GET['error'])){
          switch ($_GET['error']) {
      case 'none':
        # code...$
        $message = 'Signup Success';
        $alertType = 'alert-success';
        break;
        case 'wrongpassword':
          # code...
          $message = 'Wrong password';
          $alertType = 'alert-warning';
          break;
        case 'invalidurl':
          # code...
          $message = 'Wrong Url';
          $alertType = 'alert-danger';
          break;
          case 'uidtaken':
            # code...
            $message = 'Email Already Registered';
            $alertType = 'alert-info';
            break;
          case 'stmtfailed':
            # code...
            $message = 'Unknown Server Error';
            $alertType = 'alert-warning';
            break;
      
      default:
        # code...
        $message = 'Welcome';
        $alertType = 'alert-info';
        break;
          }
          echo "<script>
                    notificationAdd('".$message." ' , '".$alertType."');
                </script>";
          
        }
        else{
          echo "<script>
                    notificationAdd('Hello Dear' , 'alert-info');
                </script>";
          
        }
        
    
  ?>


  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
      <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#3f4ad1"/></svg>

        <div class="container">
          <div class="carousel-caption text-start">
            <h1><span style="color:red;">Currencynet</span> Converter Version 1.0</h1> 
            <p>Build ur website with ease</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up to begin</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#e2cb2b"/></svg>

        <div class="container">
          <div class="carousel-caption">
            <h1><span style='color:#8a2be2'>Bootstrap</span> For Currency </h1>
            <p>Give your customers satisfaction and confidence when trading with you in your website</p>
            <p>  <code class='code'><script src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/currencynet/scripts/test.js" ></script></code> </p>
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
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
          </div>
        </div>
      </div>
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
      

  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <h1>In Three Steps</h1>
    <div class="row">
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2>SIGN UP</h2>
        <p>To start your currency conversion your need to create an account</p>
        <p><a class="btn btn-secondary" href="#form_signup" role="button">Sign Up now &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2>ADD PROPERTY</h2>
        <p>Get your website ready by verifying ownership of the property.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2>PASTE CDN</h2>
        <p>paste our CDN to begin development. click the button below to copy link</p>
        <p><a class="btn btn-secondary" href="#" role="button">Copy Link &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->

    <h2>SIGN IN</h2>
    <section class="form-signin container" id='form_signup'>
        <form action='inc/signup.inc.php' class="row g-3" method='post' id='login-signup'>
                  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">Email</label>
    <input type="email" name='post_mail' id='mail'  class="form-control-plaintext" id="staticEmail2" placeholder="email@example.com">
  </div>
<div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Password</label>
    <input type="password" name='post_pass' class="form-control" id="inputPassword2" placeholder="Password">
  </div>
        <!-- <input type='email' name='post_mail' id='mail' placeholder='email' required> -->
                <!-- <input type='password' name='post_pass' placeholder='password' autocomplete="" accesskey='w' required> -->
               <div class="col-auto">
    <button type="submit" id='formSubmit' name='post_login_submit'  class="btn btn-primary mb-3">Confirm identity</button>
  </div>
                <!-- <input type='submit' id='formSubmit' name='post_login_submit' placeholder='Submit' value='submit'  required> -->
                <form>
                    <script>
                        
                        let formInput = document.querySelector("#login-signup");
                        let formSubmit = document.querySelector("#formSubmit"); 
                    </script>
                    <span class='errormsg'></span>

                 
        </section>


        <script>
          let codeBlock = document.querySelectorAll('code');
          // console.log(codeBlock);
          Array.prototype.forEach.call(codeBlock, element => {
            let preText = element.innerHTML;
            // console.log(preText);
            element.innerText = preText;
          })
    
    $(document).ready(function () {
        // $("#login-signup").submit(function (event) {
            let mailInput = document.querySelector('#mail');
            mailInput.addEventListener('input', () => {
            // event.preventDefault();
            let mail_index = mailInput.value;
            // console.log('hello');
            
            



            $(".errormsg").load("inc/signup.inc.php", {
                mail_index: mail_index
                

            });
            // console.log(1);
        });
        
    });

    


</script>   

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->
    <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <h1>Meet the Developer</h1>
    <div class="row">
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2>ANIEZEOFOR MICHAEL.C</h2>
        <p>
          <ul class="list-group">
            <li class="list-group-item">Lead Developer</li>
            <li class="list-group-item">BackEnd Developer</li>
            <li class="list-group-item">UX-UI Developers</li>

          </ul> 
      </p>
        <p><a class="btn btn-secondary" href="https://github.com/codad5" role="button">GITHUB <i class="fab fa-github"></i> &raquo;</a></p>

      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2>EMECHEBE PAUL-SIMON. U</h2>
        <p><ul class="list-group">
            <li class="list-group-item">Front-End Developer</li>
            <li class="list-group-item">UX-UI Developers</li>
            <li class="list-group-item">JavaScript Developer</li>
          </ul> </p>
        <p><a class="btn btn-secondary" href="https://github.com/PTBYSR" role="button">GITHUB <i class="fab fa-github"></i> &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2>JERRY-GEORGE OKIEOMO</h2>
        <p><ul class="list-group">
          <li class="list-group-item">Lead Developer</li>
            <li class="list-group-item">Technical Supervisor</li>
            <li class="list-group-item">JavaScript Developer</li>
          </ul></p>
        <p><a class="btn btn-secondary" href="https://github.com/jerrygeorge360" role="button">GITHUB <i class="fab fa-github"></i> &raquo;</a></p>

      </div><!-- /.col-lg-4 -->
    </div>

  </div><!-- /.container -->
  
 


  <!-- FOOTER -->
  <?php include_once 'footer.php'; ?>
  
</main>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>