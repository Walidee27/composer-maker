<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('page/mentions_legales.html.twig');
    }

    #[Route('/cgu', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('page/cgu.html.twig');
    }

    #[Route('/cgv', name: 'app_cgv')]
    public function cgv(): Response
    {
        return $this->render('page/cgv.html.twig');
    }

    #[Route('/politique-confidentialite', name: 'app_politique_confidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('page/politique_confidentialite.html.twig');
    }

    #[Route('/qui-sommes-nous', name: 'app_qui_sommes_nous')]
    public function quiSommesNous(): Response
    {
        return $this->render('page/qui_sommes_nous.html.twig');
    }

    #[Route('/developpement-durable', name: 'app_developpement_durable')]
    public function developpementDurable(): Response
    {
        return $this->render('page/developpement_durable.html.twig');
    }

    #[Route('/livraison-retours', name: 'app_livraison_retours')]
    public function livraisonRetours(): Response
    {
        return $this->render('page/livraison_retours.html.twig');
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('page/faq.html.twig');
    }

    #[Route('/carrieres', name: 'app_carrieres')]
    public function carrieres(): Response
    {
        return $this->render('page/carrieres.html.twig');
    }
}
