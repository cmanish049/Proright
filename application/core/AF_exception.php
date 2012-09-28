<?php


/**
 * Description of AF_exception
 *
 * @author Alexander
 */
class AF_exception extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        // some code
    
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }
    
    public function errorMessage()
    {
        log_message('error', $this->getMessage());
        return $this->getMessage();
    }
}
