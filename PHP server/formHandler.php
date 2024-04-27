<!--
Author: Noah Jackson
Course: Web Programming
Assignment:PHP Project
File purpose: Handles HTML form submission and 
              sanitizes and validates certain input fields
-->

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form data
        //For all user input fields, the inputs are sanitized for security
        $fname = sanitizeInput($_POST['fname']);  
        $lname = sanitizeInput($_POST['lname']);
        $email = sanitizeInput($_POST['email']);
        $phone = sanitizeInput($_POST['phone']);
        $radio = $_POST['radio'];
        $resume = handleCheckbox('resume');
        $linkedIn = handleCheckbox('LinkedIn');
        $gitHub = handleCheckbox('GitHub');
        $rating = $_POST['rating'];
    }

    /*Try catch block function for the checkboxes options 
          allows for an Undefined POST variable warning 
          to be handled and display "No"
          for when a checkbox was option was not selected*/
    function handleCheckbox(string $postVar) {
        try {
            if(!isset($_POST[$postVar])) {
                throw new Exception("POST variable "
                                    .$postVar." is not defined.");
            } else return $_POST[$postVar];
        } catch (Exception $e) {
            // Handle the exception by defining response as No
            return 'No';
        }  
    }

    //Inputs a unsanitized string and returns a sanitized one
    function sanitizeInput(string $str) {
        return filter_var($str, FILTER_SANITIZE_STRING);
    }
?>

<!-- Displays a landing page after the user submits the form-->
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <link rel="stylesheet">
        <title>Form Handler</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <!-- Button that returns the user to the home page-->
        <a href="https://storage.googleapis.com/portfolio909350/contact.html">
            <button>Back to Homepage</button>
        </a>
        <h1>Form Received</h1>
        <h2>Thank for participating in this form!</h2>
        <h3>Your responses:</h3>
        <!-- Displays the users form responses-->
       
        <p>
            First name: <?php echo($fname);?> <br>
            Last name: <?php echo($lname);?> <br>
            Email: <?php echo($email);?> 
                <!--Echos in red if the email provided does not exist-->
                <span style="color: red;">
                    <?php 
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "";
                        } else {
                            echo ".    Warning: Invalid Email";
                        }
                    ?>
                </span> <br>
            Phone Number: <?php echo($phone);?> <br>
            Hiring Recruiter (Y/N): <?php echo($radio);?> <br>
            Coming from Resume: <?php echo($resume);?> <br>
            Coming from LinkedIn: <?php echo($linkedIn);?> <br>
            Coming from GitHub: <?php echo($gitHub);?> <br>
            Rating: <?php echo($rating);?> <br>
        </p>
    </body>
</html>
