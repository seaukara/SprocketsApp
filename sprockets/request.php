<?php get_header()?>
<hr class="divider">
  <h2 class="text-center text-lg text-uppercase my-0">Contact<strong>Form</strong></h2>
<hr class="divider">
<?php
  //put it at the top to allow you to be able to quickly change it
  //Point this to the clients email when done
  $to = 'karamanseau@gmail.com';

  if(isset($_POST["FirstName"]))
    {//if data, show it

    $FirstName = clean_post('FirstName');
    $LastName = clean_post('LastName');
    $Email = clean_post('Email');
    // $Comments = clean_post('Comments');

    $myText = process_post();

    // $myText = "The user has entered their information as follows:" . PHP_EOL . PHP_EOL; //double newlines 
    // $myText .= $FirstName . " " . $LastName . PHP_EOL . PHP_EOL; //PHP_EOL is a php command for a carriage return
    // $myText .= $Comments . PHP_EOL;

    $subject = 'ITC 240 Contact From ' . $FirstName . ' ' . $LastName . ' ' . date('m/d/y, G:i:s');
    $headers = 'From: noreply@thelandmarks.com' . PHP_EOL .
        'Reply-To: ' . $Email . PHP_EOL .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $myText, $headers);
    echo '
    <h4>Your message was successfully sent!</h4>
    <p>We\'ll get back to you within 48 hours</p>
    <p><a href="">Exit</a></p>


    ';

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
        
    }else{//show form

      /*
      Radio buttons

      Appointment Type

      Intake
      Degree Audit
      Registration

      Checkboxes

      Special Requests

      Onlines meeting
      Early morning
      Official Transcript

      Appointment Date
      */


    echo '
      <div class="bg-faded p-4 my-4">
        <form action="" method="post">
          <div class="row">
            <div class="form-group col-lg-4">
              <label class="text-heading">Name</label>
              <input type="text" name="FirstName" autofocus required class="form-control">
            </div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Last Name</label>
              <input type="text" name="LastName" required class="form-control">
            </div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Email Address</label>
              <input type="email" name="Email" required class="form-control">
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Appointment Type</label> <br />
              <input type="radio" name="Appointment_Type" value="Intake" /> Intake <br />
              <input type="radio" name="Appointment_Type" value="Degree Audit" /> Degree Audit <br />
              <input type="radio" name="Appointment_Type" value="Registration" /> Registration <br />
            </div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Special Requests</label> <br />
              <input type="checkbox" name="Special_Requests[]" value="Online Meeting" /> Online Meeting <br />
              <input type="checkbox" name="Special_Requests[]" value="Early Morning" /> Early Morning <br />
              <input type="checkbox" name="Special_Requests[]" value="Official Transcript" /> Official Transcript <br />
            </div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Appointment Date/Time</label>
              <input type="date" name="Appointment_Time" required class="form-control">
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-12">
              <label class="text-heading">Message</label>
              <textarea class="form-control" name="Comments" rows="6"></textarea>
            </div>
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    ';
  }  
?>

<?php 

get_footer();

function clean_post($key){
  if(isset($_POST[$key])){
    return strip_tags(trim($_POST[$key]));
  }else{
    return '';
  }
}

function process_post()
{//loop through POST vars and return a single string
    $myReturn = ''; //set to initial empty value

    foreach($_POST as $varName=> $value)
    {#loop POST vars to create JS array on the current page - include email
         $strippedVarName = str_replace("_"," ",$varName);#remove underscores
        if(is_array($_POST[$varName]))
         {#checkboxes are arrays, and we need to collapse the array to comma separated string!
             $myReturn .= $strippedVarName . ": " . implode(",",$_POST[$varName]) . PHP_EOL;
         }else{//not an array, create line
             $myReturn .= $strippedVarName . ": " . $value . PHP_EOL;
         }
    }
    return $myReturn;
}




