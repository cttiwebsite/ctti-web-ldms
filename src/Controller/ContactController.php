<?php
namespace App\Controller;
use App\Entity\Section;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(EntityManagerInterface $entityManager): Response
    {
        $sections = $entityManager->getRepository(Section::class)->findAll();
        return $this->render('pages/contact.html.twig',['sections'=>$sections,]);
    }
}
