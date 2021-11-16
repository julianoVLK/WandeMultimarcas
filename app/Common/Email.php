<?php

namespace App\Common;

use PHPMailer\PHPMailer\PHPmailer;
use PHPMailer\PHPmailer\Exception as PHPMailerException;

class Email {
    const HOST = 'smt.gmail.com';
    const USER = 'julianovorvo@gmail.com';
    const PASS = 'rosane1618';
    const SECURE = 'TLS';
    const PORT = '587';
    const CHARSET = 'UTF-8';

    const FROM_EMAIL = 'juliano_vorvo@gmail.com';
    const FROM_NAME = 'Juliano Cesar Volski';

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
            $obMail->Host = self::HOST;
            $obMail->SMTPAuth = true;
            $obMail->Username = self::USER;
            $obMail->Password = self::PASS;
            $obMail->SMTPSecure = self::SECURE;
            $obMail->Port = self::PORT;
            $obMail->CharSet = self::CHARSET;

            //Remetente
            $obMail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

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