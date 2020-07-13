<?php

namespace App\Controller;

use App\Services\LinkGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Link;
use App\Repository\LinkRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/link", methods={"POST"}, name="generateLink")
     */
    public function generateLink(Request $request, EntityManagerInterface $entityManager, LinkRepository $linkRepository, ValidatorInterface $validator)
    {
        $longLink = $request->request->get('link');

        $link = $linkRepository->findOneBy(['long_link' => $longLink]);

        if(!$link)
        {
            $link = new Link();
            $link->setLongLink($longLink);
            $link->setShortLink(crc32($longLink));
            $link->setCreateDate(new \DateTime());

            if(count($validator->validate($link))){
                return $this->json(['message' => 'Validation error'], 400);
            }

            $entityManager->persist($link);
            $entityManager->flush();
        }

        return $this->json(['link' => $this->generateUrl('getLink', [
            'link' => $link->getShortLink(),
        ])]);
    }

    /**
     * @Route("/link/{link}", methods={"GET"}, name="getLink")
     */
    public function getLink(Request $request, LinkRepository $linkRepository, $link)
    {
        $link = $linkRepository->findOneBy(['short_link' => $link]);
        if($link){
            return $this->render('link.html.twig',['redirecrLink' => $link->getLongLink()]);
        }
        return new Response($this->renderView('404.html.twig'), 404);
    }
}
