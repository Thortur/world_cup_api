<?php
declare (strict_types = 1);
namespace worldCup;
use \SendRequete\SendRequete;
header('Content-Type: text/html; charset=UTF-8');
require_once './SendRequete.class.php';

$fct  = 'createUser';
$data = array(
    'id'          => -1,
    'nom'         => 'Aaaa',
    'prenom'      => 'Bbbb',
    'pseudo'      => 'Cccc',
    'avatar'      => 5,
    'password'    => 'azerty',
    'mail'        => 'lefevre.christophe@outlook.com',
    'mailConfirm' => false,
);

// echo '<pre>';
//send requete
$SendRequete = new SendRequete($fct, $data);
$reponse     = $SendRequete->exec();

// show resultat
echo '<pre>';
    echo $reponse;
    var_dump($reponse);
    print_r($reponse);
echo '</pre>';


die;
require_once './../app/Autoloader.class.php';
\AppApiRest\Autoloader::register();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

class User {
    private $id;
    private $mail;
    public function __construct(array $data){
        $this->setId((int)$data['id']);
        $this->setMail((string)$data['mail']);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail(string $mail)
    {
        $this->mail = $mail;

        return $this;
    }
}

$User = new User(array('id' => 1, 'mail' => 'lefevre.christophe@outlook.com'));

$SendMail = new \SendMail\SendMail(array(
    'mailAuto' => true,
    'destinataire' => array(
        'mail' => 'lefevre.christophe@outlook.com',
        'nom'  => 'Thortur',
    ),
    'subject' => 'Confirmation d\'adresse mail',
    'body'    => 'Bonjour,
    Vous venez de vous inscrire Mais votre compte n\'est pas encore actif.
    Pour l\'activer et passé un bon petit moment, clique sur le lien suivant pour confimer ton adresse mail : <a href="https://www.worldcup.lefevrechristophe.fr/public/confirmMail.php?id='.$User->getId().'&mail='.$User->getMail().'">Je confirme mon adresse mail!</a>
    Sinon tu fais rien...
    Bonne journée, ou fin de journée, ou bonne nuit... c\'est comme tu veux.',
    'altBody' => '',
));
$SendMail->send();



echo '</pre>';