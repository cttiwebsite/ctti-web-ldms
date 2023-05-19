<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgramController extends AbstractController
{
    #[Route('/course', name: 'courses')]
    public function coursesIndex(): Response
    {
        return $this->render('pages/courses.html.twig');
    }

    #[Route('/admin/add_program', name: 'create_program')]
    public function CreateProgram(EntityManagerInterface $entityManager, Request $request)
    {
      
        $program=new program();
        $form= $this->createForm(type:ProgramType::class,data:$program);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $section=$form->get('section')->getData();
            $entityManager->persist($program);
            $entityManager->flush();
        }
        return $this->render('admin/create_program.html.twig', ['programForm'=>$form->createView()]);
    }

    #[Route('/admin/view_programs', name: 'view_programs')]
    public function showPrograms(EntityManagerInterface $entityManager): Response
    {
        $programs = $entityManager->getRepository(Program::class)->findAll();

        if (!$programs) 
        {
            throw $this->createNotFoundException( 'No programs found ' );
        }

        return $this->render('admin/show_programs.html.twig', ['programs' => $programs,]);
    }
    
}
