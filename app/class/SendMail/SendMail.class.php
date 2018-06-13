<?php
namespace SendMail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMail {

    /**
     * mail auto suite action user
     * 
     * @var bool $mailAuto
     */
    private $mailAuto;
    /**
     * adresse mail du destinataire
     * 
     * @var string $mailDestinataire
     */
    private $mailDestinataire;
    /**
     * nom du destinataire
     * 
     * @var string $nomDestinataire
     */
    private $nomDestinataire;
    /**
     * adresse en copie du mail
     * 
     * @var string $mailCopie
     */
    private $mailCopie;
    /**
     * object du mail
     * 
     * @var string $subject
     */
    private $subject;
    /**
     * body du mail
     * 
     * @var string $body
     */
    private $body;
    /**
     * object du mail
     * 
     * @var string $altBody
     */
    private $altBody;
    /**
     * Nom de la personne qui envoi le mail
     * 
     * @var string $userName
     */
    private $userName;
    /**
     * Nom de la personne qui envoi le mail
     * 
     * @var string $from
     */
    private $from;

    /**
     * Construct de la class
     * 
     * @var array $datas
     */
    public function __construct($datas) {
        $this->setMailAuto((bool)$datas['mailAuto']);
        $this->setMailDestinataire((string)$datas['destinataire']['mail']);
        $this->setNomDestinataire((string)$datas['destinataire']['nom']);
        $this->setSubject((string)$datas['subject']);
        $this->setBody((string)$datas['body']);
        $this->setAltBody((string)$datas['altBody']);
        $this->setUserName('World Cup - lefevrechristophe.fr');
        $this->setFrom('support@lefevrechristophe.fr');
    }

    /**
     * Envoi du mail
     * 
     * @return bool status envoi mail
     */
    public function send() {
        $mail = new PHPMailer(true);                             // Passing `true` enables exceptions
        try {
            
            $mail->CharSet = $mail::CHARSET_UTF8;
            //Recipients
            $mail->setFrom($this->getFrom(), $this->getUserName());
            $mail->addAddress($this->getMailDestinataire(), $this->getNomDestinataire());     // Add a recipient
            $mail->addReplyTo('support@lefevrechristophe.fr', 'Supprot Word cup - lefevrechristophe.fr');
            if(empty($this->getMailCopie()) === false) {
                $mail->addCC($this->getMailCopie());
            }
            $mail->addBCC('support@lefevrechristophe.fr');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                    // Set email format to HTML
            $mail->Subject = $this->getSubject();
            $mail->Body    = $this->getBody();
            $mail->AltBody = $this->getAltBody();

            $mail->send();
            return true;
        }
        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            return false;  
        }
    }

    /**
     * Is $mailAuto
     *
     * @return  bool
     */ 
    public function isMailAuto()
    {
        return $this->mailAuto;
    }

    /**
     * Set $mailAuto
     *
     * @param  bool  $mailAuto  $mailAuto
     *
     * @return  self
     */ 
    public function setMailAuto(bool $mailAuto)
    {
        $this->mailAuto = $mailAuto;

        return $this;
    }

    /**
     * Get $mailDestinataire
     *
     * @return  string
     */ 
    public function getMailDestinataire()
    {
        return $this->mailDestinataire;
    }

    /**
     * Set $mailDestinataire
     *
     * @param  string  $mailDestinataire  $mailDestinataire
     *
     * @return  self
     */ 
    public function setMailDestinataire(string $mailDestinataire)
    {
        $this->mailDestinataire = $mailDestinataire;

        return $this;
    }

    /**
     * Get $mailDestinataire
     *
     * @return  string
     */ 
    public function getNomDestinataire()
    {
        return $this->nomDestinataire;
    }

    /**
     * Set $nomDestinataire
     *
     * @param  string  $nomDestinataire  $nomDestinataire
     *
     * @return  self
     */ 
    public function setNomDestinataire(string $nomDestinataire)
    {
        $this->nomDestinataire = $nomDestinataire;

        return $this;
    }

     /**
     * Get $mailCopie
     *
     * @return  string
     */ 
    public function getMailCopie()
    {
        return $this->mailCopie;
    }

    /**
     * Set $mailCopie
     *
     * @param  string|array  $mailCopie  $mailCopie
     *
     * @return  self
     */ 
    public function setMailCopie($mailCopie)
    {
        if(is_array($mailCopie) === true) {
            $this->mailCopie = implode(';', $mailCopie);
        }
        else {
            $this->mailCopie = (string)$mailCopie;
        }

        return $this;
    }

    /**
     * Get $subject
     *
     * @return  string
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set $subject
     *
     * @param  string  $subject  $subject
     *
     * @return  self
     */ 
    public function setSubject(string $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get $body
     *
     * @return  string
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set $body
     *
     * @param  string  $body  $body
     *
     * @return  self
     */ 
    public function setBody(string $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get $altBody
     *
     * @return  string
     */ 
    public function getAltBody()
    {
        return $this->altBody;
    }

    /**
     * Set $altBody
     *
     * @param  string  $altBody  $altBody
     *
     * @return  self
     */ 
    public function setAltBody(string $altBody)
    {
        if(empty($altBody) === true) {
            $altBody = 'This is the body in plain text for non-HTML mail clients';
        }
        $this->altBody = $altBody;

        return $this;
    }

    /**
     * Get $userName
     *
     * @return  string
     */ 
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set $userName
     *
     * @param  string  $userName  $userName
     *
     * @return  self
     */ 
    public function setUserName(string $userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get $from
     *
     * @return  string
     */ 
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set $from
     *
     * @param  string  $from  $from
     *
     * @return  self
     */ 
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
    }
}