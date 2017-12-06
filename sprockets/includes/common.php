<?php
//stores our favorite functions

/*
handles database and other errors


*/

function myerror($myFile, $myLine, $errorMsg)
{
    if(defined('DEBUG') && DEBUG)
    {
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
		echo "I'm sorry, we have encountered an error.  Would you like to buy some socks?";
		die();
    }
}

function get_header($file=''){
    global $config;
    static $header_loaded = false;
    if($file == ''){//load included file
        if(!$header_loaded)
        {//header loads first time
            $file = 'header.php'; 
            $header_loaded = true;
        }else{
            $file = 'footer.php';
        }
           
    }
    
    $file = $config->physical_path . '/themes/' . $config->theme . '/' . $file;
    
    if(file_exists($file)){
        include $file;
    }else{
        myerror(__FILE__,__LINE__,'include file not found: ' . $file);
    }
    
    
}#end get_header()

function get_footer()
{
    global $config;
    get_header();
}#get_footer() is same function, run second time with footer file


/**
 * Wrapper function for processing data pulled from db
 *
 * Forward slashes are added to MySQL data upon entry to prevent SQL errors.  
 * Using our dbOut() function allows us to encapsulate the most common functions for removing  
 * slashes with the PHP stripslashes() function, plus the trim() function to remove spaces.
 *
 * @param string $str data as pulled from MySQL
 * @return $str data cleaned of slashes, spaces around string, etc.
 * @see dbIn()
 * @todo none
 */
function dbOut($str)
{
    if($str!=""){$str = stripslashes(trim($str));}//strip out slashes entered for SQL safety
    return $str;
} #End dbOut()

