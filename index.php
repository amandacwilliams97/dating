<?php
/*
 * Amanda Williams
 * January 17, 2019
 * 328/dating/index.php
 */

#Start session
session_start();

#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

#require autoload
require_once ('vendor/autoload.php');

#create an instance of the Base class
$f3 = Base::instance();

#Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);


#-------------------------------------------------------------------------------
#define a default route
$f3->route('GET /', function($f3) {
    //$f3->set('page',"home");
    //$f3->set('title',"Home Page");
    $view = new Template;
    echo $view->render('views/home.html');
});

#-------------------------------------------------------------------------------
#Route to personal-information.html
$f3->route('GET /personalInfo', function($f3) {
    //$f3->set('page',"personal-information");
    //$f3->set('title',"Personal Information");
    $view = new Template;
    echo $view->render('views/personal-information.html');
});

#-------------------------------------------------------------------------------
#Route to profile.html
$f3->route('POST /profile', function($f3) {
    $f3->set('page',"profile");
    $f3->set('title',"Profile");
    //array of states
    $f3->set('states', array("Alabama", "Alaska", "Arizona", "Arkansas",
        "California", "Colorado", "Connecticut", "Delaware", "Florida",
        "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas",
        "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts",
        "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana",
        "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico",
        "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma",
        "Oregon", "Pennsylvania", "Rhode Island", "South Carolina",
        "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia",
        "Washington", "West Virginia", "Wisconsin", "Wyoming"));
    $view = new Template;
    echo $view->render('views/profile.html');
});

#-------------------------------------------------------------------------------
#Route to interests.html


$f3->route('POST /interests', function($f3) {
    //$f3->set('page',"interests");
    //$f3->set('title',"Interests");
    $f3->set('indoor', array("tv"=>"Watch T.V.", "couch"=>"Eating the couch",
        "barking"=>"Barking at Animals Outside", "board-games"=>"Board Games",
        "puzzles"=>"Puzzles", "reading"=>"Reading",
        "playing-cards"=>"Playing Cards",
        "video-games"=>"Video Games"));
    $f3->set('outdoor', array("hiking"=>"Hiking", "fetch"=>"Playing fetch",
        "swimming"=>"Swimming", "collecting"=>"Collecting sticks",
        "walks"=>"WALKWALKWALK", "chaseCat"=>"Chasing Cats"));
    $view = new Template;
    echo $view->render('views/interests.html');
});


#-------------------------------------------------------------------------------
#Create route to summary page
$f3->route('POST /summary', function($f3) {
    //$f3->set('page', 'summary');
    //$f3->set('title',"Profile Summary");

    $f3->set('name', 'Spot');
    $f3->set('gender', 'Male');
    $f3->set('age', '4');
    $f3->set('phone', '(253) 555-5555');
    $f3->set('email', 'spot4@ruff.com');
    $f3->set('state', 'Washington');
    $f3->set('seeking', 'Borker');
    $f3->set('interests', 'lots of stuff');

    $view= new Template();
    echo $view->render('views/summary.html');
});

#-------------------------------------------------------------------------------
#run fat free
$f3->run();


/*
 * test if a form has been submitted or not
 * if(isset($_POST['submit'])
 *
 * validate checkboxes. If valid, then go to next page
 *      else, stay on same page and display error.
 */