<?php
//code envoie des emails
namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;
class emailService
{

protected $app_name;
protected $host;
protected $port;
protected $username;
protected $password;

function __construct()
{
    $this->app_name=config('app.name');//va dans config dossier trouve moi le fichier app et cherche moi la variable name qui contient le nom de projet
    $this->host=config('app.mail_host');
    $this->port=config('app.mail_port');
    $this->username=config('app.mail_user');
    $this->password=config('app.mail_pass');
}


public function sendEmail($subject,$emailUser,$nameUser,$isHtml,$msg)
{
   $mail=new PHPMailer();
   $mail->isSMTP();
   $mail->SMTPDebug=0;
   $mail->Host=$this->host;
   $mail->Port=$this->port;
   $mail->Username=$this->username;
   $mail->Password=$this->password;
   $mail->SMTPAuth=true;
   $mail->Subject=$subject;
   $mail->setFrom($this->app_name,$this->app_name);
   $mail->addReplyTo($this->app_name,$this->app_name);
   $mail->addAddress($emailUser,$nameUser);
   $mail->isHtml($isHtml);
   $mail->Body=$msg;
   $mail->send();
}


}
