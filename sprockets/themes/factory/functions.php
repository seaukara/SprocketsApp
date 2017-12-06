<?php

function create_copyright() {
$first_date = 2017;

$thisYear = (int)date('Y');
echo '<strong>' . get_siteName( 'name' ) . '</strong><br>';
if ( substr( $first_date, 0, 4 ) == date( 'Y' ) ) {
echo date( 'Y' ) . '<strong> - All rights reserved</strong>';
} else {
echo substr( $first_date, 0, 4 ) . "-" . date( 'Y' ) . " - ";
}

}

function get_siteName() {
    if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        echo $_SERVER['HTTP_HOST'];
    }
?>