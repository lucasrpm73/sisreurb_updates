<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Myemail{
	/**
     * @var array
     */

    public function __construct() {
        $this->CI =& get_instance();
        //$this->CI->config->load('myemail');
    }

    /**
     * @param Array $data
     * @return Array
     * @throws \Exception
     */

    public function emailEsqueciSenha($email, $token){
      	// Load Composer's autoloader
  		require 'vendor/autoload.php';

  		// Instantiation and passing `true` enables exceptions
  		$mail = new PHPMailer(true);

  		try {
  			 //$mail = new PHPMailer\PHPMailer\PHPMailer();
  			$mail->CharSet = 'UTF-8';
  			 $mail->IsSMTP(); // enable SMTP
  			 //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
  			 $mail->SMTPAuth = true; // authentication enabled
  			 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
  			 $mail->Host = "mail.sivo.com.br";
  			 $mail->Port = 465; // or 587
  			 $mail->IsHTML(true);
  			 $mail->Username = "contato@sivo.com.br";
  			 $mail->Password = "9w@t?~mZdQQH";
  			 $mail->SetFrom("contato@sivo.com.br");
  			 $mail->Subject = "Redefinir senha";
  			 $mail->Body = "<h5>Você solicitou recentemente uma alteração de senha no site Project Name.<br> <a href='".base_url()."login/recuperar/$token'>Clique aqui</a> para redefinir sua senha.<br>O link expira em 2 horas.<br> <a href='".base_url()."login/recuperar/$token'>'".base_url()."login/recuperar/$token'</a> Caso não tenha sido você, desconsidere este email.</h5> <br><span style='color: #e56;'>E-mail automático, por favor, não responda.</span>";
  			 $mail->AddAddress($email);
  		     if(!$mail->Send()) {
  		       //echo "Mailer Error: " . $mail->ErrorInfo;
  		     } else {
  		       //echo "Mensagem enviada com sucesso";
  		     }
  		} catch (Exception $e) {
  		   //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  		}
    }
}
