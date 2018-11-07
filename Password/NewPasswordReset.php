<?php



/* New password reset


	PHP emails don't have stmp mail functions so the emails are going to spam. The mail framework should fix that.
	
	All in 1 password reset should include: 
	
	Admin access in the staff, provider, caregiver edit form to invoke this reset process.
	Same process can be used for the Forgot password link.
	
	Once started a token is automatically generated that acts as a key to access the reset function. ( COULD USE SALT? NOT SURE IF SAFE )
	
	In the reset email, the link to the reset page should include the email itself AND the token.
	
	IF both of those are present display a new password form.
	
	on completion update the users password
	
	ISSUES: Where to include security questions?
	
	
TODO:
	GET THIRD PARTY MAIL FRAMEWORK TO WORK
	Change reset to email link with token and email as credentials.
	Reset password page.
*/


//HTML EMAIL STYLING
$Name = "Coty Crosby";

$message = '<html>';

$message .= "<head><style> tr, th, td { border: none;}</style></head>";

$message .= '<body>';
 
$message .= '<table  rules="all" style="width: 100%; border: none;" cellpadding="10">';
 
$message .= "<tr><td><img src='http://www.thesaigroup.org/wp-admin/TeleSystem/images/care-cappital-logo.png' alt='care cAPPital' /></td></tr>";
 
$message .= "<tr><td colspan=2>Dear ". $Name. ",<br /><br />You or our admins have requested a password reset. <br>Please click this <a href='#' >link</a> to continue.</td></tr>";
 
$message .= "<tr><td colspan=2 font='colr:#999999;'><I><hr>Care Cappital<br>Stay healthy. :)</I></td></tr>"; 
 
$message .= "</table>";
 
$message .= "</body></html>";

echo $message;
?>