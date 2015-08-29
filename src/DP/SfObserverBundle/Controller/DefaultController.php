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
        // déclaration des paramètres des écouteurs
        $this->container->get('dp.affichage_prevision_listener')->setCurrentPressure(1000);
        $this->container->get('dp.affichage_stat_listener')->setMinTemp(10);
        $this->container->get('dp.affichage_stat_listener')->setMaxTemp(30);

        $donneesMeteo = $this->container->get('dp.donnees_meteo');
        $donneesMeteo->setMesures(25, 10, 1200); // le sujet met à jour ses données

        $affichageConditions = $this->container->get('dp.affichage_condition_listener')->getNewValues();
        $affichageStats = $this->container->get('dp.affichage_stat_listener')->getNewValues();
        $affichagePrevisions = $this->container->get('dp.affichage_prevision_listener')->getNewValues();

        return array(
            'affichageConditions' => $affichageConditions,
            'affichageStats'      => $affichageStats,
            'affichagePrevisions' => $affichagePrevisions
        );
    }

    /**
     * @Route("/subscriber")
     * @Template("DPSfObserverBundle:Default:index.html.twig")
     */
    public function indexSubscriberAction()
    {
        $dispatcher = new EventDispatcher();

        $donneesMeteo = new DonneesMeteo();
        
        // déclaration des subscribers
        $affichageConditionsSubscriber   = new \DP\SfObserverBundle\Subscriber\AffichageConditionsSubscriber();
        $affichageStatsSubscriber   = new \DP\SfObserverBundle\Subscriber\AffichageStatsSubscriber(200, 0.0);
        $affichagePrevisionsSubscriber   = new \DP\SfObserverBundle\Subscriber\AffichagePrevisionsSubscriber(29.2);
        
        // enregistrement des subscribers
        $dispatcher->addSubscriber($affichageConditionsSubscriber);
        $dispatcher->addSubscriber($affichageStatsSubscriber);
        $dispatcher->addSubscriber($affichagePrevisionsSubscriber);
        
        
        $donneesMeteo->setDispatcher($dispatcher);
        $donneesMeteo->setMesures(25, 10, 1200); // le sujet met à jour ses données

        return array(
            'affichageConditions' => $affichageConditionsSubscriber,
            'affichageStats'      => $affichageStatsSubscriber,
            'affichagePrevisions' => $affichagePrevisionsSubscriber
        );
    }

}