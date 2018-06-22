<?php
declare(strict_types = 1);
namespace Cagnotte;
use \DateTime;

class CagnotteManager {

    /**
     * Calcul du montant de la cagnotte
     * 
     * @param array $listCagnotte
     * @return float $montant
     */
    public static function getCagnottesUser(array $listCagnotte) {
        $montant = 0;
        if(is_array($listCagnotte) === true && empty($listCagnotte) === false) {
            foreach($listCagnotte as $cagnotte) {
                $montant += $cagnotte['montant'];
            }
            unset($cagnotte);
        }

        return $montant;
    }
}