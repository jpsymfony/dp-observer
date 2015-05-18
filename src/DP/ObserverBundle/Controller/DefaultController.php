<?php

namespace DP\ObserverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DP\ObserverBundle\Entity\Observable\DonneesMeteo;
use DP\ObserverBundle\Entity\Observer\AffichageConditions;
use DP\ObserverBundle\Entity\Observer\AffichageStats;
use DP\ObserverBundle\Entity\Observer\AffichagePrevisions;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="observer")
     * @Template()
     */
    public function indexAction()
    {
        $donneesMeteo        = new DonneesMeteo(); // sujet, celui qui est observé
        $affichageConditions = new AffichageConditions($donneesMeteo); // l'observateur, à qui on passe l'observé en argument 
        // plutôt que d'appeler la fonction $affichageConditions->add($donneesMeteo)
        $affichageStats      = new AffichageStats($donneesMeteo, 200, 0.0); // l'observateur, à qui on passe l'observé en argument 
        // plutôt que d'appeler la fonction $affichageStats->add($donneesMeteo)
        $affichagePrevisions = new AffichagePrevisions($donneesMeteo, 29.2); // l'observateur, à qui on passe l'observé en argument 
        // plutôt que d'appeler la fonction $affichagePrevisions->add($donneesMeteo)

        $donneesMeteo->setMesures(25, 10, 1200); // le sujet met à jour ses données

        return array(
            'affichageConditions' => $affichageConditions,
            'affichageStats'      => $affichageStats,
            'affichagePrevisions' => $affichagePrevisions
        );
    }

}