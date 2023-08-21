<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * @param Array $data
 * @return Array
 * @throws \Exception
 */

class Bkp extends CI_Controller {
  public function __construct(){
		parent::__construct();

    if (!isset($_SERVER['PHP_AUTH_USER'])) {
      header('WWW-Authenticate: Basic realm="My Realm"');
      header('HTTP/1.0 401 Unauthorized');
      echo 'Text to send if user hits Cancel button';
      exit;
    } else {
      if ($_SERVER['PHP_AUTH_USER'] != "iDwQwH2^Hi#u" || $_SERVER['PHP_AUTH_PW'] != "Qm2F!bbnkg*B") {
        die('Não autorizado');
      }
    }
	}

	public function index(){
    // echo "ola"; die;
    $teste = $this->load->dbutil();
    // // var_dump($teste);
    $date = date("m_d_Y_H_i_s");
    $prefs = array(
        'format'      => 'zip',
        'filename'    => 'dump_'.$date.'.sql'
        );


    $backup = $this->dbutil->backup($prefs);

    $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
    $save = '/home/sisreurbcom/bd/'.$db_name;
    // // echo $save;
    //
    $this->load->helper('file');
    $teste = file_put_contents($save, $backup);

    // $this->load->helper('download');
    // force_download($db_name, $backup);

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
       //$mail = new PHPMailer\PHPMailer\PHPMailer();
       $mail->CharSet = 'UTF-8';
       $mail->IsSMTP(); // enable SMTP
       //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
       $mail->SMTPAuth = true; // authentication enabled
       $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
       $mail->Host = "mail.jltecno.com.br";
       $mail->Port = 465; // or 587
       $mail->IsHTML(true);
       $mail->Username = "bbd@jltecno.com.br";
       $mail->Password = "kRiBRSyq&M.E";
       $mail->SetFrom("bbd@jltecno.com.br");
       $mail->Subject = "Backup Sisreurb";
       $mail->Body = "<h5>Backup do dia ".$date."</span>";
       $mail->AddAddress('lucas_alves_lbas@hotmail.com');
       // $mail->AddAttachment('C:\wamp64\www\keromais\bd\dump_'.$date.'.sql');
       $mail->AddAttachment($save);
       // /home/dominio/pasta/nomedoarquivo
         if(!$mail->Send()) {
           // echo "Mailer Error: " . $mail->ErrorInfo;
         } else {
           // echo "Mensagem enviada com sucesso";
         }
    } catch (Exception $e) {
       // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

  }
}
