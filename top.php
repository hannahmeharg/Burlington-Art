<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);

 ?>	
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mark me wrong</title>

        <meta charset="utf-8">
        <meta name="author" content="Mark me wrong">
        <meta name="description" content="Mark me wrong for not changing this">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        

        <?php
        $debug = false;

        // This if statement allows us in the classroom to see what our variables are
        // This is NEVER done on a live site 
        if (isset($_GET["debug"])) {
            $debug = true;
        }

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//








        if ($debug) {

            print '<p>php Self: ' . $phpSelf;
            print '<p>Path Parts<pre>';
            print_r($path_parts);
            print '</pre></p>';
        }

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries. 
// 
// 
// 
//
        print  PHP_EOL . '<!-- include libraries -->' . PHP_EOL;












        print  PHP_EOL . '<!-- finished including libraries -->' . PHP_EOL;
        ?>	

    </head>
    <!-- ################ body section ######################### -->

    <?php
    print '<body id="' . $path_parts['filename'] . '">';

    include 'header.php';
    include 'nav.php';

    if ($debug) {
        print '<p>DEBUG MODE IS ON</p>';
    }
    ?>
