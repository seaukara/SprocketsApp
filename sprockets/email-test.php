<?php
//email-test.php


if(mail("karamanseau@gmail.com","My Clever Subject Line!","Test email"))
{//email sent?
	echo 'Email sent?';
}else{//email NOT sent!
	echo 'Email NOT sent!';
}

