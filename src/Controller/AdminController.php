<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\User;
use App\Entity\Faculty;
use App\Entity\Program;
use App\Entity\Student;
use App\Form\StudentType;
use App\Form\FacultyType;
use App\Form\NewsType;
use App\Form\UserType;
use App\Form\ProgramType;
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

    #[Route('/admin/add_section', name: 'add_section')]
    public function createFaculty(EntityManagerInterface $entityManager, Request $request): Response
    {
        $section=new Faculty();
        $form= $this->createForm(type:FacultyType::class, data:$section);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $entityManager->persist($section);
            $entityManager->flush();
            dump($request);
        }
        return $this->render('admin/create_section.html.twig', ['form'=>$form->createView()]);

    }

    #[Route('/admin/add_news', name: 'add_news')]
    public function createNews(EntityManagerInterface $entityManager, Request $request): Response
    {
        $news=new News();
        $form= $this->createForm(type:NewsType::class,data:$news);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $entityManager->persist($news);
            $entityManager->flush();
        }
        return $this->render('admin/create_news.html.twig', ['form'=>$form->createView()]);

    }

    #[Route('/admin/add_program', name: 'add_program')]
    public function createProgram(EntityManagerInterface $entityManager, Request $request): Response
    {
        $program=new Program();
        $form= $this->createForm(type:ProgramType::class,data:$program);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $entityManager->persist($program);
            $entityManager->flush();
        }
        return $this->render('admin/create_program.html.twig', ['form'=>$form->createView()]);

    }
    #[Route('/admin/add_student', name: 'add_student')]
    public function createStudent(EntityManagerInterface $entityManager): Response
    {
        $student=new Student(); 
        $form= $this->createForm(type:StudentType::class,data:$student);
         
        if($form->isSubmitted())
        {
            $entityManager->persist($student);
            $entityManager->flush();
        }
        return $this->render('admin/create_student.html.twig', ['form'=>$form->createView()]);

     
    }
    
    #[Route('/admin/user/{id}', name: 'user_show')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) 
        {
            throw $this->createNotFoundException( 'No product found for id '.$id );
        }

        return new Response('Check out this user: '.$user->getEmail());
 
        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    } 

     
    #[Route('/admin/news', name: 'news_show')]
    public function showNews(EntityManagerInterface $entityManager): Response
    {
        $news = $entityManager->getRepository(News::class)->findAll();

        if (!$news) 
        {
            throw $this->createNotFoundException( 'No News Found');
        } 

      return $this->render('product/show.html.twig', ['news' => $news]);
    } 
    
    #[Route('/admin/remove_user/{id}', name: 'user_remove')]
    public function removeUser(EntityManagerInterface $entityManager, User $user)
    {
        $user=new User();
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirect($this->generateUrl(route:'dashboard'));
    }

    #[Route('/admin/remove_news', name: 'delete_event')]
    public function removeNews(EntityManagerInterface $entityManager)
    {
    $news=new News();
    $entityManager->remove($news);
    $entityManager->flush();
    return $this->redirect($this->generateUrl(route:'dashboard'));
   }
}
