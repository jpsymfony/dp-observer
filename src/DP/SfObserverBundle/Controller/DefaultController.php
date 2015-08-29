<?php

namespace DP\SfObserverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        // déclaration des paramètres des écouteurs
        $affichageConditionsListener   = $this->container->get('dp.affichage_condition_listener');
        $affichageStatsListener   = $this->container->get('dp.affichage_stat_listener');
        $affichagePrevisionsListener   = $this->container->get('dp.affichage_prevision_listener');
        $affichageStatsListener->setMinTemp(10);
        $affichageStatsListener->setMaxTemp(30);
        $affichagePrevisionsListener->setCurrentPressure(1000);

        $donneesMeteo = $this->container->get('dp.donnees_meteo');
        $donneesMeteo->setMesures(25, 10, 1200); // le sujet met à jour ses données

        return array(
            'affichageConditions' => $affichageConditionsListener->getNewValues(),
            'affichageStats'      => $affichageStatsListener->getNewValues(),
            'affichagePrevisions' => $affichagePrevisionsListener->getNewValues()
        );
    }

    /**
     * @Route("/subscriber")
     * @Template("DPSfObserverBundle:Default:index.html.twig")
     */
    public function indexSubscriberAction()
    {
        // déclaration des subscribers
        $affichageConditionsSubscriber   = $this->container->get('dp.affichage_condition_subscriber');
        $affichageStatsSubscriber   = $this->container->get('dp.affichage_stat_subscriber');
        $affichagePrevisionsSubscriber   = $this->container->get('dp.affichage_prevision_subscriber');

        $affichageStatsSubscriber->setMinTemp(10);
        $affichageStatsSubscriber->setMaxTemp(30);
        $affichagePrevisionsSubscriber->setCurrentPressure(1000);

        $donneesMeteo = $this->container->get('dp.donnees_meteo');
        $donneesMeteo->setMesures(25, 10, 1200); // le sujet met à jour ses données

        return array(
            'affichageConditions' => $affichageConditionsSubscriber->getNewValues(),
            'affichageStats'      => $affichageStatsSubscriber->getNewValues(),
            'affichagePrevisions' => $affichagePrevisionsSubscriber->getNewValues()
        );

    }

}