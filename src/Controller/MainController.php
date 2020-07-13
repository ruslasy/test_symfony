<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/link", methods={"POST"}, name="generateLink")
     */
    public function generateLink(Request $request)
    {
        $data =[];
        $data[] = $request->request->get('link');

        return $this->json($data);
    }

    /**
     * @Route("/link", methods={"GET"}, name="getLink")
     */
    public function getLink()
    {
        $data =[];
        return $this->json($data);
    }
}
