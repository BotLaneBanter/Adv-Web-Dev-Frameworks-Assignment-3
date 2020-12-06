<?php

namespace QuwisSystem\Framework;

class Validator{

private $errorThrown = false;
private $errorEmail = false;
private $errorPassword = false;

public function getErrorThrown() : bool {

    return $this->errorThrown;

}

public function getErrorEmailThrown() : bool {

    return $this->errorEmail;

}

public function getErrorPasswordThrown() : bool {

    return $this->errorPassword;

}


//Check if the structure of the email is valid
public function isEmailValid (string $email) : bool 
{   
    //Check if the email is not empty
    if(!empty($email)){

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        { 
            
        $this->errorThrown = true;
        $this->errorEmail = true;
        return false;
    
        }
        else{
 
        $this->errorThrown = false;
        $this->errorEmail = false;
        return true;

        }
    }
     
$this->errorThrown = true;
$this->errorEmail = true;
return false;

}

public function passwordHashMatch(string $password, string $hashedPassword) : bool 
{

    //Check the password hash matches the provided password
    if(password_verify($password, $hashedPassword)){
       
        $this->errorThrown = false;
        $this->errorPassword = false;
        return true;
    
    }

    $this->errorThrown = true;
    $this->errorPassword = true;
    return false;

}

//Checks if password is valid
public function isPasswordValid(string $password) : bool
{

    $passLength = strlen($password);

    //Checks to see if password is not empty
    if(isset($password))
    {
        
        //Check to see password is at least of length 8
        if($passLength < 10)
        {
            $this->errorThrown = true;
            $this->errorPassword = true;
            return false;
        }

        //Check to see if password is alphanumeric
        if(!ctype_alnum($password))
        {
            $this->errorThrown = true;
            $this->errorPassword = true;
            return false;
        }
        
        $numExists = false;
        $position = 0;
        //Check to see if password contains a digit
        for( $position = 0; $position < $passLength; $position++ )
        {
            if(isset($position))
            {
            //Takes 1 character out of the string at $position (1,2,3 etc.)
            $passChar = substr($password, $position, 1);
            
                if(ctype_digit($passChar))
                {
                    $numExists = true;
                }
            }
        }

        //Check if a digit was found
        if($numExists != true)
        {
            $this->errorThrown = true;
            $this->errorPassword = true;
            $numExists = false;
            return false; 
        }

        $position = 0;
        //Check to see if password contains an uppercase
        for( $position = 0; $position < $passLength; $position++ )
        {
            if(isset($position))
            {
            //Takes 1 character out of the string at $position (1,2,3 etc.)
            $passChar = substr($password, $position, 1);
            
                if(ctype_upper($passChar))
                {
                    $this->errorThrown = false;
                    $this->errorPassword = false;
                    return true;
                }
            }
        }
    

    }

    
   $this->errorThrown = true;
   $this->errorPassword = true;
   return false;
    
}


}

?>