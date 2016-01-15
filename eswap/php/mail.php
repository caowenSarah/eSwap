<?php
	$user = $_POST["visitor_email"];
	$msg = $_POST["msg"];
	$proposer_email = $_POST["proposer_email"];
	$proposer_name = $_POST["proposer_name"];
	$visitor_name = $_POST["visitor_name"];
	require "../include/mailutil/PHPMailerAutoload.php";

	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.sina.cn;smtp.sina.cn';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'eswapweb@sina.cn';                 // SMTP username
	$mail->Password = 'eswap0203';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	$mail->From = 'eswapweb@sina.cn';
	$mail->FromName = 'eSwap';
	$mail->addAddress("$proposer_email", "$proposer_name");     // Add a recipient
	$mail->addReplyTo("$user", "$visitor_name");
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'From eSwap user';
	$mail->Body    = "$msg" . "<br/><br/><br/><code><em>Please reply directly to chat with $visitor_name!</em></code>";

	if(!$mail->send()) {
	    echo 'Message could not be sent. ' . 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo true;
	}
?>