<?php

namespace DP\SplObserverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DP\SplObserverBundle\Entity\Observable\DonneesMeteo;
use DP\SplObserverBundle\Entity\Observer\AffichageConditions;
use DP\SplObserverBundle\Entity\Observer\AffichageStats;
use DP\SplObserverBundle\Entity\Observer\AffichagePrevisions;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="spl_observer")
     * @Template()
     */
    public function indexAction()
    {
        $donneesMeteo        = new DonneesMeteo(); // sujet, celui qui est observé
        $affichageConditions = new AffichageConditions($donneesMeteo); // l'observateur, à qui on passe l'observé en argument 
        // plutôt que d'appeler la fonction $affichageConditions->add($donneesMeteo)
        $affichageStats      = new AffichageStats($donneesMeteo, 10, 30); // l'observateur, à qui on passe l'observé en argument
        // plutôt que d'appeler la fonction $affichageStats->add($donneesMeteo)
        $affichagePrevisions = new AffichagePrevisions($donneesMeteo, 29.2); // l'observateur, à qui on passe l'observé en argument 
        // plutôt que d'appeler la fonction $affichagePrevisions->add($donneesMeteo)

        $donneesMeteo->setMesures(25, 10, 1200); // le sujet met à jour ses données

        return array(
            'affichageConditions' => $affichageConditions->getNewValues(),
            'affichageStats'      => $affichageStats->getNewValues(),
            'affichagePrevisions' => $affichagePrevisions->getNewValues()
        );
    }

}