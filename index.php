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
#require validation file
require ('model/validation-functions.php');

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
$f3->route('GET|POST /personalInfo', function($f3) {
    //$f3->set('page',"personal-information");
    //$f3->set('title',"Personal Information");
    $view = new Template;
    echo $view->render('views/personal-information.html');
});

#-------------------------------------------------------------------------------
#Route to profile.html
$f3->route('POST /profile', function($f3) {
    //$f3->set('page',"profile");
    //$f3->set('title',"Profile");

    $f3->set('errorFirstName', '');
    $f3->set('errorLastName', '');
    $f3->set('errorAge', '');
    $f3->set('errorPhone', '');

    //array of states
     $states=array("Alabama"=>"",
        "Alaska"=>"",
        "Arizona"=>"",
        "Arkansas"=>"",
        "California"=>"",
        "Colorado"=>"",
        "Connecticut"=>"",
        "Delaware"=>"",
        "Florida"=>"",
        "Georgia"=>"",
        "Hawaii"=>"",
        "Idaho"=>"",
        "Illinois"=>"",
        "Indiana"=>"",
        "Iowa"=>"",
        "Kansas"=>"",
        "Kentucky"=>"",
        "Louisiana",
        "Maine",
        "Maryland",
        "Massachusetts",
        "Michigan"=>"",
        "Minnesota",
        "Mississippi",
        "Missouri",
        "Montana",
        "Nebraska"=>"",
        "Nevada"=>"",
        "New Hampshire"=>"",
        "New Jersey"=>"",
        "New Mexico"=>"",
        "New York"=>"",
        "North Carolina"=>"",
        "North Dakota"=>"",
        "Ohio"=>"",
        "Oklahoma"=>"",
        "Oregon"=>"",
        "Pennsylvania"=>"",
        "Rhode Island"=>"",
        "South Carolina"=>"",
        "South Dakota"=>"",
        "Tennessee"=>"",
        "Texas"=>"",
        "Utah"=>"",
        "Vermont"=>"",
        "Virginia"=>"",
        "Washington"=>"",
        "West Virginia"=>"",
        "Wisconsin"=>"",
        "Wyoming"=>"");
     //if(!empty($_POST['state'])) {$states[$_POST['state']]='selected';}

    $f3->set('states',$states);
    $view = new Template;

    #validate and assign data
    if(validName($_POST['firstName'])
        &&validName($_POST['lastName'])
        &&validAge($_POST['age'])
        &&validPhone($_POST['phoneNum'])) { #if all inputs are valid
        $_SESSION['firstName']=$_POST['firstName'];
        $_SESSION['lastName']=$_POST['lastName'];
        $_SESSION['age']=$_POST['age'];
        $_SESSION['phoneNum']=$_POST['phoneNum'];
        $_SESSION['gender']=$_POST['gender'];

        echo $view->render('views/profile.html');
    }#load next form
    else { #any inputs are invalid
        if(!validName($_POST['firstName'])) {$f3->set('errorFirstName',"Please provide a first name.");}
        if(!validName($_POST['lastName']))  {$f3->set('errorLastName',"Please provide a last name.");}
        if(!validAge($_POST['age']))        {$f3->set('errorAge',"Please be 18 or older.");}
        if(!validPhone($_POST['phoneNum'])) {$f3->set('errorPhone',"Please provide a phone number 
                                                in the following format : 2223334444");}
        #make form sticky
        if($_POST['gender']=="male"){$f3->set('male','checked');}
        if($_POST['gender']=="female"){$f3->set('female','checked');}

        $f3->set('firstName',$_POST['firstName']);
        $f3->set('lastName',$_POST['lastName']);
        $f3->set('age',$_POST['age']);
        $f3->set('phoneNum',$_POST['phoneNum']);


        echo $view->render('views/personal-information.html');
    }#reload page
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
        "swimming"=>"Swimming", "collectStick"=>"Collecting sticks",
        "walks"=>"WALKWALKWALK", "chaseCat"=>"Chasing Cats"));
    $f3->set('errorEmail', ''); #initialize error as empty
    $view = new Template;

    if(!($_POST['email']==='')) { #if email is provided
        $_SESSION['email']=$_POST['email'];
        $_SESSION['state']=$_POST['state'];
        $_SESSION['seeking']=$_POST['seeking'];
        $_SESSION['biography']=$_POST['biography'];

        echo $view->render('views/interests.html');
    }
    else { #email was not provided
        $f3->set('errorEmail', 'Please provide an email address.');
        $f3->set('states',$_POST['state']);

        if($_POST['seeking']=="borker"){$f3->set('borker','checked');}
        if($_POST['seeking']=="moon-moon"){$f3->set('moonMoon','checked');}

        $f3->set('biography',$_POST['biography']);
        echo $view->render('views/profile.html');
    }
});

#-------------------------------------------------------------------------------
#Create route to summary page
$f3->route('POST /summary', function($f3) {
    //$f3->set('page', 'summary');
    //$f3->set('title',"Profile Summary");
    $f3->set('errorInterests', '');
    $view= new Template();

    #interests are valid
    if(validIndoor($_POST['inDoorInt'])&& validOutdoor($_POST['outDoorInt'])) {
        $f3->set('interests', validIndoor($_POST['inDoorInt']));
        $f3->set('outerests', validIndoor($_POST['outDoorInt']));

        #if a gender is not chosen
        if($_SESSION['gender']!='male'||$_SESSION['gender']!='female'){$f3->set('gender', 'Not Given');}
        else{$f3->set('gender', $_SESSION['gender']);}

        $f3->set('fName', $_SESSION['firstName']);
        $f3->set('lName', $_SESSION['lastName']);
        $f3->set('age', $_SESSION['age']);
        $f3->set('phone', $_SESSION['phoneNum']);
        $f3->set('email', $_SESSION['email']);
        $f3->set('state', $_SESSION['state']);
        $f3->set('seeking', $_SESSION['seeking']);

        $f3->set('biography', $_SESSION['biography']);

        echo $view->render('views/summary.html');
    }#print summary
    else { #interests are not valid
        $f3->set('errorInterests', 'What are you doing?');
        $f3->set('selectedInt',$_POST['inDoorInt']);
        $f3->set('selectedOut',$_POST['outDoorInt']);
        echo $view->render('views/interests.html');
    }#reload form and STOP HACKING
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