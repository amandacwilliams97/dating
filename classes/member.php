<?php
/**
 * Created by PhpStorm.
 * User: mandy
 * Date: 2/14/2019
 * Time: 12:28 PM
 */

/**
 * @author Amanda Williams
 * @copyright
 * @version 1.0
 * Class Member
 */

class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param $fname , first name
     * @param $lname , last name
     * @param $age , age
     * @param $gender , gender
     * @param $phone , phone number
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
    }

    /**
     * @return mixed fname, first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param $fname, first name
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed lname, last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param  $lname, last name
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param  $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return mixed gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param  $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return mixed phone
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param  $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param  $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param  $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return mixed seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param  $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return mixed bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param  $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

}
