<?php
/**
 * Created by PhpStorm.
 * User: mandy
 * Date: 2/1/2019
 * Time: 3:48 PM
 */
/*
 * Amanda Williams
 * February 1, 2019
 * 328/dating/model/validation-functions.php
 */

#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

//if form submits, validate inputs

function validName($input)
{
    return ctype_alpha(str_replace(' ','',$input));
}

function validAge($input)
{
    return ((18===$input||18<$input)&& is_numeric($input));
}

function validPhone($input)
{
    #inline validation used in tag
    #but i'll check anyway.
    $validPhoneNum='/[0-9]{3}[0-9]{3}[0-9]{4}/';
    return preg_match($validPhoneNum,$input)&&(!preg_match('/[0-9]{11,}/',$input));//(is_numeric($input))&&
}

function validIndoor($inputs)
{
    $output="";
    $validIndoor=array("tv"=>"Watch T.V.", "couch"=>"Eating the couch",
        "barking"=>"Barking at Animals Outside", "board-games"=>"Board Games",
        "puzzles"=>"Puzzles", "reading"=>"Reading",
        "playing-cards"=>"Playing Cards",
        "video-games"=>"Video Games");
    foreach($inputs as $input) {
        if(!key_exists($input, $validIndoor)){return "False";}
        if(!($input==$inputs[0]))$output.=", ";
        $output.=$validIndoor[$input];
    }
    return $output;
}

function validOutdoor($inputs)
{
    $output="";
    $validOutdoor=array("hiking"=>"Hiking", "fetch"=>"Playing fetch",
        "swimming"=>"Swimming", "collectStick"=>"Collecting sticks",
        "walks"=>"WALKWALKWALK", "chaseCat"=>"Chasing Cats");
    foreach($inputs as $input) {
        if(!key_exists($input, $validOutdoor)){return "False";}
        if(!($input==$inputs[0]))$output.=", ";
        $output.=$validOutdoor[$input];
    }
    return $output;
}

#test validName()
/*
echo "Charlie Town: ";
echo (validName("Charlie Town")) ? "True" : "False"; //True

echo "<br>";
echo "Char12e To3n: ";
echo validName("Char12e To3n") ?"True" :"False"; //False

echo "<br>";
echo "Char:'e To-+: ";
echo validName("Char:'e To-+") ?"True" :"False"; //False
*/
#test validAge()
/*
$age1=4;
$age2='34a';
$age4 = 50;
$age3=18;
$age5='28';
echo "<p>Age-> $age1: ".(validAge($age1)?"True":"False"). //False
    "<br>Age-> $age2: ".(validAge($age2)?"True":"False"). //False
    "<br>Age-> $age4: ".(validAge($age4)?"True":"False"). //True
    "<br>Age-> $age3: ".(validAge($age3)?"True":"False"). //True
    "<br>Age-> $age5: ".(validAge($age5)?"True":"False"). //True
    "</p>";
*/
#test validPhone()
/*
$phoneNum1= 11122233334;
$phoneNum2='11a2223b33';
$phoneNum3='1112223333';
$phoneNum4='(111)222-3333';
$phoneNum5= 253875381;
$phoneNum6= 25387538137454;

echo "<p>Phone-> $phoneNum1: ".(validPhone($phoneNum1)?"True":"False"). //False
    "<br>Phone-> $phoneNum2: ".(validPhone($phoneNum2)?"True":"False"). //False
    "<br>Phone-> $phoneNum3: ".(validPhone($phoneNum3)?"True":"False"). //True
    "<br>Phone-> $phoneNum4: ".(validPhone($phoneNum4)?"True":"False"). //False
    "<br>Phone-> $phoneNum5: ".(validPhone($phoneNum5)?"True":"False"). //False
    "<br>Phone-> $phoneNum6: ".(validPhone($phoneNum6)?"True":"False"). //False
    "</p>";
*/
#test validIndoor()
/*
$indoor1=array("tv","couch","barking","board-games",);
$indoor2=array("tv","couch","baring","board-games",);
$indoor3=array("tv","couch","barking","board-games","puzzles","reading");
$indoor4=array("tv","couch","barking","board-game","puzzles","reading");
$indoor5=array("tv","couch","barking","board-games","puzzles","reading","playing-cards","video-games");
$indoor6=array("tv","couch","barking","board-games","puzzles","reading","playingcards","video-games");

echo "<p>Indoor->1 True: ".validIndoor($indoor1). //True
    "<br>Indoor->2 False: ".validIndoor($indoor2). //False
    "<br>Indoor->3 True: ".validIndoor($indoor3). //True
    "<br>Indoor->4 False: ".validIndoor($indoor4). //False
    "<br>Indoor->5 True: ".validIndoor($indoor5). //True
    "<br>Indoor->6 False: ".validIndoor($indoor6). //False
    "</p>";
*/
#test validOutdoor()
/*
$outdoor1=array("hiking","fetch");
$outdoor2=array("hiking","fetc");
$outdoor3=array("hiking","fetch","swimming","collectStick");
$outdoor4=array("hiking","fetch","swimming","collectStic");
$outdoor5=array("hiking","fetch","swimming","collectStick","walks","chaseCat");
$outdoor6=array("hiking","fetch","swimming","collectStick","walks","chaseCa");

echo "<p>Indoor->1: ".validOutdoor($outdoor1). //True
    "<br>Indoor->2: ".validOutdoor($outdoor2). //False
    "<br>Indoor->3: ".validOutdoor($outdoor3). //True
    "<br>Indoor->4: ".validOutdoor($outdoor4). //False
    "<br>Indoor->5: ".validOutdoor($outdoor5). //True
    "<br>Indoor->6: ".validOutdoor($outdoor6). //False
    "</p>";
*/