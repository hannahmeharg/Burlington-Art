<?php
include 'top.php';
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
if ($debug){  // later you can uncomment the if statement
    print '<p>Post Array:</p><pre>';
    print_r($_POST);
    print '</pre>';
}

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.

$thisURL = $domain . $phpSelf;


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form
 
$firstName = '';

$lastName = '';
 
$email = 'evan.ray@uvm.edu';

$artist = 'No';

$medium = "Painting";  // pick the option

$galleryOne = true; //checked
$galleryTwo = false;  //not checked
$galleryThree = false;  //not checked
$galleryFour = false;  //not checked
$noGallery = false;  //not checked

$questions = '';

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;

$lastNameERROR = false;

$emailERROR = false;

$artistERROR = false;

$mediumError = false;

$galleryERROR = false;
$totalChecked = 0;

$questionsERROR = false;

////%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();

// array used to hold form values that will be written to a CSV file
$dataRecord = array();

// have we mailed the information to the user?
$mailed=false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2a Security
    // 
    if (!securityCheck($thisURL)) {       
         $msg = '<p>Sorry you cannot access this page. ';     
         $msg.= 'Security breach detected and reported.</p>';       
         die($msg);   
    }
     
     
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2b Sanitize (clean) data 
    // remove any potential JavaScript or html code from users input on the
// form. Note it is best to follow the same order as declared in section 1c.
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;
    
    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;
    
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email; 
     
    $artist = htmlentities($_POST["radArtist"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $artist;
    
    $medium = htmlentities($_POST["lstMedium"],ENT_QUOTES,"UTF-8");
    $dataRecord[] = $medium;
    
    $questions = htmlentities($_POST["txtQuestions"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $questions;
    
        if (isset($_POST["chkGalleryOne"])) {
        $galleryOne = true;
        $totalChecked++;
    } else {
        $galleryOne = false;
    }
    $dataRecord[] = $galleryOne;
    
    if (isset($_POST["chkGalleryTwo"])) {
        $galleryTwo = true;
        $totalChecked++;
    } else {
        $galleryTwo = false;
    }
    $dataRecord[] = $galleryTwo;
    
        if (isset($_POST["chkGalleryThree"])) {
        $galleryThree = true;
        $totalChecked++;
    } else {
        $galleryThree = false;
    }
    $dataRecord[] = $galleryThree;
    
        if (isset($_POST["chkGalleryFour"])) {
        $galleryFour = true;
        $totalChecked++;
    } else {
        $galleryFour = false;
    }
    $dataRecord[] = $galleryFour;
    
            if (isset($_POST["chkNoGallery"])) {
        $noGallery = true;
        $totalChecked++;
    } else {
        $noGallery = false;
    }
    $dataRecord[] = $noGallery;
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra characters.";
        $firstNameERROR = true;
    }
    
    if ($lastName == "") {
        $errorMsg[] = "Please enter your last name";
        $lastNameERROR = true;
    } elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = "Your first name appears to have extra characters.";
        $lastNameERROR = true;
    }       
    
    if ($email == "") { 
         $errorMsg[] = 'Please enter your email address';
         $emailERROR = true;
    } elseif (!verifyEmail($email)) {
         $errorMsg[] = 'Your email address appears to be incorrect.';
         $emailERROR = true;
    }
     
    if($artist != 'Yes' AND $artist != 'Amateur' AND $artist != 'No') {
        $errorMsg[] = 'Please choose your level of artistic proficiency';
        $artistERROR = true; 
    }
    
    if($medium == ""){
        $errorMsg[] = "Please choose a favorite medium";
        $mediumError = true;
    }
    
    if($totalChecked < 1){
        $errorMsg[] = "Please tell us if you have vistied any of our local galleries";
        $galleryERROR = true;
    }
  
    if ($questions != "") { 
        if (!verifyAlphaNum($questions)) {
            $errorMsg[] = "Your questions appear to have extra characters that are not allowed.";
            $questionsERROR = true;
        }
    }
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    // 
    if (!$errorMsg) {
        if ($debug)
            print PHP_EOL . '<p>Form is valid</p>';
    
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2e Save Data
    //
    // This block saves the data to a CSV file. 
    $myFolder = 'data/'; 
        
    $myFileName = 'registration';    
        
    $fileExt = '.csv';
        
    $filename = $myFolder . $myFileName . $fileExt;
    if ($debug) print PHP_EOL . '<p>filename is ' . $filename;
    
    // now we just open the file for append
    $file = fopen($filename, 'a');
        
    // write the forms informations
    fputcsv($file, $dataRecord);
        
    // close the file
    fclose($file);


    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2f Create message
    //
    // build a message to display on the screen in section 3a and to mail
    // to the person filling out the form (section 2g).
    
    $message = '<h2>Your information.</h2>';
        
    foreach ($_POST as $htmlName => $value) {    
        
        $message .= '<p>';
        // breaks up the form names into words. for example
        // txtFirstName becomes First Name
        $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));
        
        foreach ($camelCase as $oneWord) {
            $message .= $oneWord . ' ';
        }
        
        $message .= ' = ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';
        
    }    
              
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2g Mail to user
    //
    // Process for mailing a message which contains the forms data
    // the message was built in section 2f.
    $to = $email; // the person who filled out the form
    $cc = '';    
    $bcc = '';    
        
    $from = 'Evan Ray <evan.ray@uvm.edu>';    
        
    // subject of mail should make sense to your form    
    $subject = 'Burlington Art';    
        
    $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);    
        
        
        } // end form is valid
        
    }   // ends if form was submitted.
        
      
//#############################################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">
 
    <?php
    //####################################
    //
    // SECTION 3a. 
    // 
    // If its the first time coming to the form or there are errors we are going
    // to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
        print '<h2>Thank you for providing your information.</h2>';
        
        print '<p>For your records a copy of this data has ';

        if (!$mailed) {
            print "not ";
        }
        print 'been sent:</p>';
        print '<p>To: ' . $email . '</p>';
        
            print $message;
        } else {

            print '<h2>Contact Us!</h2>';
            print '<p class="form-heading">Please feel free to ask us any questions.'
            . ' We would greatly appriciate if you filled out the short survey below.'
                    . ' Thank you!</p>';

            //####################################
            //
            // SECTION 3b Error Messages
            //
            // display any error messages before we print out the form
            
        if ($errorMsg) {
            print '<div id="errors">' . PHP_EOL;
            print '<h2>Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
            print '<ol>' . PHP_EOL;
       
            foreach ($errorMsg as $err) {
                print '<li>' . $err . '</li>' . PHP_EOL;
            }
        
            print '</ol>' . PHP_EOL;
            print '</div>' . PHP_EOL;
        }
            
        //####################################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
        is defined in top.php
        NOTE the line:
        value="<?php print $email; ?>
        this makes the form sticky by displaying either the initial default value (line ??)
        or the value they typed in (line ??)
        NOTE this line:
        <?php if($emailERROR) print 'class="mistake"'; ?>
        this prints out a css class so that we can highlight the background etc. to
        make it stand out that a mistake happened here.
    */
?>

    <form action="<?php print $phpSelf; ?>"
          id="frmSubmit"
          method="post">

            <fieldset class="contactInfo">
                <legend>Contact Information</legend>
                <p>
                    <label class="required text-field" for="txtFirstName">First Name</label>
                    <input autofocus
                           <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                           id="txtFirstName"
                           maxlength="45"
                           name="txtFirstName"
                           onfocus="this.select()"
                           placeholder="Enter your first name"
                           tabindex="100"
                           type="text"
                           value="<?php print $firstName; ?>"
                    >
                </p>
                
                <p>
                    <label class="required text-field" for="txtLastName">Last Name</label>
                    <input 
                           <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                           id="txtLastName"
                           maxlength="45"
                           name="txtLastName"
                           onfocus="this.select()"
                           placeholder="Enter your last name"
                           tabindex="100"
                           type="text"
                           value="<?php print $lastName; ?>"
                    >
                </p>
            

            <p>   
                <label class="required text-field" for="txtEmail">Email</label>
                    <input 
                        <?php if ($emailERROR) print 'class="mistake"'; ?>
                    id="txtEmail"
                    maxlength="45"
                    name="txtEmail"
                    onfocus="this.select()"
                    placeholder="Email address"
                    tabindex="120"
                    type="text"
                    value="<?php print $email; ?>"
                >
            </p>
        </fieldset> <!-- ends contact -->

        <fieldset class="radio <?php if ($artistERROR) print ' mistake'; ?>">
            <legend>Are you an artist?</legend>
            <p>
                <label class="radio-field">
                    <input type="radio" 
                           id="radArtistYes"
                           name="radArtist"
                           value="Yes"
                           tabindex="572"
                           <?php if ($artist == "Yes") echo ' checked="checked" '; ?>>
                    Yes</label>
            </p>
            
            <p>
                <label class="radio-field">
                    <input type="radio" 
                           id="radArtistAmateur"
                           name="radArtist"
                           value="Amateur"
                           tabindex="572"
                           <?php if ($artist == "Amateur") echo ' checked="checked" '; ?>>
                    Amateur</label>
            </p>
            <p>
                <label class="radio-field">
                    <input type="radio" 
                           id="radArtistNo"
                           name="radArtist"
                           value="No"
                           tabindex="572"
                           <?php if ($artist == "No") echo ' checked="checked" '; ?>>
                    No</label>
            </p>
        </fieldset>
        
            <fieldset  class="listbox <?php if ($mediumERROR) print ' mistake'; ?>">
            <legend>Favorite Medium</legend>
        <p>
            <select id="lstMedium"
                    name="lstMedium"
                    tabindex="520" >
                <option <?php if($medium=="Drawing") print " selected "; ?>
                    value="Drawing"> Drawing</option>
                
                <option <?php if($medium=="Painting") print " selected "; ?>
                    value="Painting"> Painting</option>
                
                <option <?php if($medium=="Sculpture") print " selected "; ?>
                    value="Sculpture"> Sculpture</option>
                </select>
        </p>           
            </fieldset>
        
        <fieldset class="checkbox <?php if ($galleryERROR) print ' mistake'; ?>">
            <legend>Have you been to any of our local galleries?</legend>
            
            <p>
                <label class="check-field">
                    <input <?php if ($galleryOne) print " checked "; ?>
                        id="chkGalleryOne"
                        name="chkGalleryOne"
                        tabindex="420"
                        type="checkbox"
                        value="GalleryOne"> Champlain College Art Gallery</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($galleryTwo)  print " checked "; ?>
                        id="chkGalleryTwo"
                        name="chkGalleryTwo"
                        tabindex="430"
                        type="checkbox"
                        value="GalleryTwo"> The BCA Center</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($galleryThree)  print " checked "; ?>
                        id="chkGalleryThree"
                        name="chkGalleryThree"
                        tabindex="430"
                        type="checkbox"
                        value="GalleryThree"> Robert Hull Fleming Museum</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($galleryFour)  print " checked "; ?>
                        id="chkGalleryFour"
                        name="chkGalleryFour"
                        tabindex="430"
                        type="checkbox"
                        value="GalleryFour"> Frog Hollow Vermont State Craft Center</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($noGallery)  print " checked "; ?>
                        id="chkNoGallery"
                        name="chkNoGallery"
                        tabindex="430"
                        type="checkbox"
                        value="NoGallery"> No</label>
            </p>    
        </fieldset>
        
        <fieldset class="textarea">
            <p>
                <label  class="required"for="txtQuestions">Questions</label>
                <textarea <?php if ($questionsERROR) print 'class="mistake"'; ?>
                    id="txtQuestions" 
                    name="txtQuestions"
                    onfocus="this.select()"
                    tabindex="200"><?php print $questions; ?></textarea>
            <!-- NOTE: no blank spaces inside the text area, be sure to close 
                             the text area directly -->
            </p>
        </fieldset>   
            
        
        <fieldset class="buttons">
            <legend></legend>
            <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Submit" >
        </fieldset> <!-- ends buttons -->
    </form>
    
    <?php 
        } //end body submit
    ?>
        <p class="clear"></p>
    </article>

<?php include 'footer.php'; ?>

</body>
</html>

