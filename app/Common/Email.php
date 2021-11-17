<?php

namespace App\Common;

use PHPMailer\PHPMailer\PHPmailer;
use PHPMailer\PHPmailer\Exception as PHPMailerException;

class Email {

    /**
     * Mensagem de erro do envio
     * @var string
     */
    private $error;

    /** 
     * Método responsável por retornar a mensagem de erro do envio
     * @return string
    */
    public function getError(){
        return $this->error;
    }

    /**
     * Método responsável por envir e-mail
     * @param string/array $adresses
     * @param string @subject
     * @param string @body
     * @param string/array $attachements
     * @param string/array $ccs
     * @param string/array $bccs
     * @return boolean
     */
    public function sendEmail($addresses, $subject, $body, $attachments = [], $ccs  = [], $bccs  = []) {
        $this->error = '';

        $obMail = new PHPMailer(true);
        try{
            //Credênciais de acesso
            $obMail->isSMTP(true);
            $obMail->Host = getenv('SMTP_HOST');
            $obMail->SMTPAuth = true;
            $obMail->Username = getenv('SMTP_USER');
            $obMail->Password = getenv('SMTP_PASS');
            $obMail->SMTPSecure = getenv('SMTP_SECURE');
            $obMail->Port = getenv('SMTP_PORT');
            $obMail->CharSet = getenv('SMTP_CHARSET');

            //Remetente
            $obMail->setFrom(getenv('SMTP_FROM_EMAIL'), getenv('SMTP_FROM_NAME'));

            //Destinatários
            $addresses = is_array($addresses) ? $addresses : [$addresses];
            foreach($addresses as $address) {
                $obMail->addAddress($address);
            }

            //Anexos
            $attachments = is_array($attachments) ? $attachments : [$attachments];
            foreach($attachments as $attachment) {
                $obMail->addAttachment($attachment);
            }

            //Cópias
             $ccs = is_array($ccs) ? $ccs : [$ccs];
             foreach($ccs as $cc) {
                 $obMail->addCC($cc);
            }

            //Cópia Oculta
            $bccs = is_array($bccs) ? $bccs : [$bccs];
            foreach($bccs as $bcc) {
                $obMail->addBCC($bcc);
            }

            //Conteúdo do E-mail
            $obMail->isHTML(true);
            $obMail->Subject = $subject;
            $obMail->Body = $body;

            //Envia E-mail
            return $obMail->send();
            
        }catch(PHPMailerException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
}