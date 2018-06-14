<?php
declare(strict_types = 1);
namespace Pari;
use \Connexion\Database;
use \DateTime;
use \User\User;
use \Match\Match;
use \Cagnotte\Cagnotte;
use \Cagnotte\CagnotteManagerMYSQL;
use \Cotes\Cotes;

class PariManager {

    public static function calculGain(User $User, Match $Match, Pari $Pari, Cotes $Cotes) {
        $dateNow = new DateTime();
        $montant = 0;
        if($Cotes->getIdTeam() === $Match->getIdVainqueur()) {
            $montant = ceil($Pari->getMontant() * $Cotes->getCote());
            $Pari->setGain($montant);
            PariManagerMYSQL::updateGain($Pari);
        }

        $Cagnotte = new Cagnotte(array(
            'id'         => -1,
            'idUser'     => $Pari->getIdUser(),
            'idPari'     => $Pari->getId(),
            'montant'    => $montant,
            'date'       => $dateNow->format('Y-m-d H:i:s'),
        ));
        CagnotteManagerMYSQL::insertCagnotte($Cagnotte);

        $SendMail = new \SendMail\SendMail(array(
            'mailAuto' => true,
            'destinataire' => array(
                'mail' => $User->getMail(),
                'nom'  => $User->getPseudo(),
            ),
            'subject' => "Un match viens de se terminer, quel son vos gains?",
            'body'    => "Bonjour,<br/>\n<br/>\nLe montant de votre gains est de ".$montant." € (Attention, c'est pas pour de vrai...) <br/>\n<br/>\nSupport.",
            'altBody' => '',
        ));
    }
}