<?php
/**
 * @author Amanda Williams
 * @copyright
 * @version 1.0
 * class PremiumMember
 */
#-------------------------------------------------------------------------------
class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

#-------------------------------------------------------------------------------
    /**
     * PremiumMember constructor.
     * @param $_inDoorInterests
     * @param $_outDoorInterests
     */
    public function __construct($fname, $lname, $age, $gender, $phone,
                                $_inDoorInterests, $_outDoorInterests)
    {
        $this->_inDoorInterests = $_inDoorInterests;
        $this->_outDoorInterests = $_outDoorInterests;
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

#-------------------------------------------------------------------------------
    #Indoor getter and setter
    /**
     * @return mixed inDoorInterests
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

#-------------------------------------------------------------------------------
    #Outdoor getter and setter
    /**
     * @return mixed outDoorInterests
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }
}