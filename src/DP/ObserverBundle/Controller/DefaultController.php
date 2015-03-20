<?php

namespace DP\ObserverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \DP\ObserverBundle\Entity\Sujet\DonneesMeteo;
use DP\ObserverBundle\Entity\Observateur\AffichageConditions;

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
        // plutôt que d'appeler la fonction $affichageConditions->enregistrerObservateur($donnesMeteo)
    
        $donneesMeteo->setMesures(25, 10, 1200); // le sujet met à jour ses données
        
        $affichageConditions->actualiser($donneesMeteo); // l'observateur actualise ses données en fonction de ce que lui transmet le sujet
        
        return array('affichageConditions' => $affichageConditions);
        
    }

}