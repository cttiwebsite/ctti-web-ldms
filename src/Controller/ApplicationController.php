<?php
namespace App\Controller;
use App\Entity\Section;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApplicationController extends AbstractController
{
    #[Route('/application', name: 'apply')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sections = $entityManager->getRepository(Section::class)->findAll();
        return $this->render('application/index.html.twig', ['sections' =>$sections,]);
    }
}
