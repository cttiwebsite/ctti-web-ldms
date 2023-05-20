<?php
namespace App\Controller;
use App\Entity\News;
use App\Entity\User;
use App\Entity\About;
use App\Entity\Event;
use App\Entity\Program;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class MainController extends AbstractController
{
    #[Route('/admin', name: 'dashboard')]
    public function dashboard(EntityManagerInterface $entityManager): Response
    {
     $user = $entityManager->getRepository(User::class);

    return $this->render('admin/dashboard.html.twig',['currentUser'=>$user]);
    }

   #[Route('/', name: 'home')]
    public function home(EntityManagerInterface $entityManager): Response
    {
        $program = $entityManager->getRepository(Program::class)->findAll();
        $news = $entityManager->getRepository(News::class)->findAll();
        $events = $entityManager->getRepository(Event::class)->findAll();
        $about = $entityManager->getRepository(About::class)->findAll();
        return $this->render('pages/home.html.twig', ['programs'=>$program,'news'=>$news,'events'=>$events,'about'=>$about]);
    }


   
   

}
