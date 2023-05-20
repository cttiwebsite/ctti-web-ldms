<?php
namespace App\Controller;
use App\Entity\Program;
use App\Entity\Section;
use App\Form\ProgramType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class ProgramController extends AbstractController
{
    #[Route('/programs', name: 'courses')]
    public function coursesIndex(EntityManagerInterface $entityManager): Response
    {
        $programs = $entityManager->getRepository(Program::class)->findAll();
        $sections = $entityManager->getRepository(Section::class)->findAll();
        return $this->render('pages/courses.html.twig',['programs' => $programs,'sections' => $sections,]);
    }

    #[Route('/course/{id}', name: 'view_program')]
    public function ViewProgram(EntityManagerInterface $entityManager, $id): Response
    {
        $program = $entityManager->getRepository(Program::class)->find($id);
        $sections = $entityManager->getRepository(Section::class)->findAll();
        if (!$program) 
        {
            throw $this->createNotFoundException('No programs found for  '.$id);
        }

        return $this->render('pages/view_course.html.twig', ['program' => $program,'sections'=>$sections]);
    }

    #[Route('/programs/{slug}', name: 'section_programs')]
    public function showProgramsBySection(EntityManagerInterface $entityManager, string $slug): Response
    {
        $section = $entityManager->getRepository(Section::class)->findBySection($slug);
        $sections = $entityManager->getRepository(Section::class)->findAll();
        $programs = $section->getPrograms();

        if (!$programs) 
        {
            throw $this->createNotFoundException('No programs found for section ' . $slug );
        }
        return $this->render('pages/coursesBySection.html.twig', ['programs' => $programs, 'sections' => $slug]);
    }

    #[Route('/admin/add_program', name: 'create_program')]
    public function CreateProgram(EntityManagerInterface $entityManager, Request $request)
    {
        $program=new program();
        $form= $this->createForm(type:ProgramType::class,data:$program);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $this->addFlash('success', 'Created Program Successfully');
            $entityManager->persist($program);
            $entityManager->flush();
        }
        return $this->render('admin/create_program.html.twig', ['programForm'=>$form->createView()]);
    }

    #[Route('/admin/view_programs', name: 'view_programs')]
    public function ViewPrograms(EntityManagerInterface $entityManager): Response
    {
        $programs = $entityManager->getRepository(Program::class)->findAll();

        if (!$programs) 
        {
            throw $this->createNotFoundException( 'No programs found ' );
        }

        return $this->render('admin/show_programs.html.twig', ['programs' => $programs,]);
    }

    #[Route('/admin/update_program/{id}', name: 'update_program')]
    public function UpdateProgram(EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $program = $entityManager->getRepository(Program::class)->find($id);
        $form= $this->createForm(type:ProgramType::class,data:$program);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($program);
            $entityManager->flush();
            $this->addFlash('success', 'Updated Program Successfully');
            return $this->redirect($this->generateUrl(route:'view_programs'));
        }
        return $this->render('admin/create_program.html.twig', ['programForm'=>$form->createView(),]);
    }

    #[Route('/admin/delete_program/{id}', name: 'delete_program')]
    public function removeProgram($id,EntityManagerInterface $entityManager):Response
    {
        $program = $entityManager->getRepository(Program::class)->find($id);
        $entityManager->remove($program);
        $entityManager->flush();
        return $this->redirect($this->generateUrl(route:'view_programs'));
    }
    
}
