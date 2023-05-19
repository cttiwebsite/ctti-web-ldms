<?php

namespace App\Controller;
use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    #[Route('/admin/add_student', name: 'create_student')]
    public function CreateStudent(EntityManagerInterface $entityManager, Request $request)
    {
      
        $student=new Student();
        $form= $this->createForm(type:StudentType::class,data:$student);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('success', 'Student Record Created Successfully!');
            $entityManager->persist($student);
            $entityManager->flush();
        }
        return $this->render('admin/create_student.html.twig', ['studentForm'=>$form->createView()]);
    }

    #[Route('/admin/view_students', name: 'view_students')]
    public function showStudents(EntityManagerInterface $entityManager): Response
    {
        $students = $entityManager->getRepository(Student::class)->findAll();

        if (!$students) 
        {
            $error="No Records Found";
            return $this->render('admin/show_students.html.twig', ['students' => $students, 'message'=>$error,]);
        }

        return $this->render('admin/show_students.html.twig', ['students' => $students,]);
    }


}
