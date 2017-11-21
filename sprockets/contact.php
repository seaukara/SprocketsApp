<?php include 'includes/config.php'?>
<?php include 'includes/header.php'?>
<hr class="divider">
  <h2 class="text-center text-lg text-uppercase my-0">Contact<strong>Form</strong></h2>
<hr class="divider">
<?php
  //put it at the top to allow you to be able to quickly change it
  //Point this to the clients email when done
  $to = 'karamanseau@gmail.com';
  $website = "The Landmarks Band Page";
  $sendEmail = TRUE; //if true, will send an email, otherwise just show user data.
  $dateFeedback = true; //if true will show date/time with reCAPTCHA error - style a div with class of dateFeedback
  include_once 'config.php'; #site keys go inside your config.php file
  include 'contact-lib/contact_include.php'; #complex unsightly code moved here
  $response = null;
  $reCaptcha = new ReCaptcha($secretKey);
  if (isset($_POST["g-recaptcha-response"]))
  {// if submitted check response
      $response = $reCaptcha->verifyResponse(
          $_SERVER["REMOTE_ADDR"],
          $_POST["g-recaptcha-response"]
      );
  }

  if ($response != null && $response->success)
    {#reCAPTCHA agrees data is valid (PROCESS FORM & SEND EMAIL)
        handle_POST($skipFields,$sendEmail,$toName,$fromAddress,$toAddress,$website,$fromDomain);             #Here we can enter the data sent into a database in a later version of this file
    

    $FirstName = clean_post('FirstName');
    $LastName = clean_post('LastName');
    $Email = clean_post('Email');
    $Comments = clean_post('Comments');

    $myText = "The user has entered their information as follows:" . PHP_EOL . PHP_EOL; //double newlines 
    $myText .= $FirstName . " " . $LastName . PHP_EOL . PHP_EOL; //PHP_EOL is a php command for a carriage return
    $myText .= $Comments . PHP_EOL;

    $subject = 'ITC 240 Contact From ' . $FirstName . ' ' . $LastName . ' ' . date('m/d/y, G:i:s');
    $headers = 'From: noreply@thelandmarks.com' . PHP_EOL .
        'Reply-To: ' . $Email . PHP_EOL .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $myText, $headers);
    ?>
    <hr class="divider">
      <h2 class="text-center txt-lg text-uppercase my-0">
        <strong>Message Sent</strong>
      </h2>
      <hr class="divider">
    <p>Thank you for your message!</p>
    <p>We'll get back to you within 48 hours</p>
    <p><a href="">Exit</a></p> 
    <!-- END HTML FEEDBACK -->        
    <?php
  }else{#show form, either for first time, or if data not valid per reCAPTCHA 
    if($response != null && !$response->success)
    {
        $feedback = dateFeedback($dateFeedback);
        send_POSTtoJS($skipFields); #function for sending POST data to JS array to reload form elements
    }//end failure feedback
 
  
  // if(isset($_POST["FirstName"]))
  //   {//if data, show it

  //   $FirstName = clean_post('FirstName');
  //   $LastName = clean_post('LastName');
  //   $Email = clean_post('Email');
  //   $Comments = clean_post('Comments');

  //   $myText = "The user has entered their information as follows:" . PHP_EOL . PHP_EOL; //double newlines 
  //   $myText .= $FirstName . " " . $LastName . PHP_EOL . PHP_EOL; //PHP_EOL is a php command for a carriage return
  //   $myText .= $Comments . PHP_EOL;

  //   $subject = 'ITC 240 Contact From ' . $FirstName . ' ' . $LastName . ' ' . date('m/d/y, G:i:s');
  //   $headers = 'From: noreply@thelandmarks.com' . PHP_EOL .
  //       'Reply-To: ' . $Email . PHP_EOL .
  //       'X-Mailer: PHP/' . phpversion();
  //   mail($to, $subject, $myText, $headers);
  //   echo '
  //   <hr class="divider">
  //     <h2 class="text-center txt-lg text-uppercase my-0">
  //       <strong>Message Sent</strong>
  //     </h2>
  //     <hr class="divider">
  //   <p>Thank you for your message!</p>
  //   <p>We\'ll get back to you within 48 hours</p>
  //   <p><a href="">Exit</a></p>


  //   ';

    // echo "
    // <p>You got a message from $FirstName $LastName.</p>
    // <p>$FirstName's email $Email</p>
    // <p>$FirstName said: </p>
    // <p>$Comments</p>
    // ";
    //    echo $_POST["FirstName"];
    //    echo '<pre>';
    //    var_dump($_POST);
    //    echo '</pre>';
        

  ?>
    <div class="bg-faded p-4 my-4">

        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="row">
            <div class="form-group col-lg-6">
              <label class="text-heading">Name</label>
              <input type="text" name="FirstName" autofocus class="form-control">
            </div>
<!--             <div class="form-group col-lg-4">
              <label class="text-heading">Last Name</label>
              <input type="text" name="LastName" class="form-control">
            </div> -->
            <div class="form-group col-lg-6">
              <label class="text-heading">Email Address</label>
              <input type="email" name="Email" class="form-control">
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-12">
              <label class="text-heading">Message</label>
              <textarea class="form-control" name="Comments" rows="6"></textarea>
            </div>
            <div class="clearfix"></div>
            <div form-group col-lg-12>
              <div><?=$feedback?></div>
              <div class="g-recaptcha" style="display:inline-block" data-sitekey="<?=$siteKey;?>"></div> 
            </div>
           <div class="clearfix"></div>
            <hr class="divider">
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
          </div>
        </form>
      </div>
        <script type="text/javascript"
        src="https://www.google.com/recaptcha/api.js?hl=en">
    </script>

<?php 
};
include 'includes/footer.php';

function clean_post($key){
  if(isset($_POST[$key])){
    return strip_tags(trim($_POST[$key]));
  }else{
    return '';
  }
}
?>