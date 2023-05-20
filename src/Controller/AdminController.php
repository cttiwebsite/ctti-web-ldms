<?php
namespace App\Controller;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function PHPSTORM_META\type;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'dashboard')]
    public function dashboard(EntityManagerInterface $entityManager): Response
    {
     $user = $entityManager->getRepository(User::class);
    return $this->render('admin/dashboard.html.twig',['currentUser'=>$user]);
    }

}
