<?php

namespace DP\SfObserverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\EventDispatcher\EventDispatcher;
use DP\SfObserverBundle\Entity\Observable\DonneesMeteo;
use DP\SfObserverBundle\Listener\AffichageConditionsListener;
use DP\SfObserverBundle\Listener\AffichagePrevisionsListener;
use DP\SfObserverBundle\Listener\AffichageStatsListener;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        //déclaration des écouteurs
        $affichageConditionsListener = array(new AffichageConditionsListener(), 'update');
        $affichageStatsListener      = array(new AffichageStatsListener(200, 0.0), 'update');
        $affichagePrevisionsListener = array(new AffichagePrevisionsListener(29.2), 'update');

        // enregistrement des écouteurs
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener('donnees_meteo.update', $affichageConditionsListener);
        $dispatcher->addListener('donnees_meteo.update', $affichagePrevisionsListener);
        $dispatcher->addListener('donnees_meteo.update', $affichageStatsListener);

        $donneesMeteo = new DonneesMeteo();
        $donneesMeteo->setDispatcher($dispatcher);
        $donneesMeteo->setMesures(25, 10, 1200); // le sujet met à jour ses données;

        return array(
            'affichageConditions' => $affichageConditionsListener[0],
            'affichageStats'      => $affichageStatsListener[0],
            'affichagePrevisions' => $affichagePrevisionsListener[0]
        );
    }

}