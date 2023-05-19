<?php
namespace App\Controller;
use App\Entity\Section;
use App\Form\SectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SectionController extends AbstractController
{
    #[Route('/admin/create_section', name: 'create_section')]
    public function CreateSection(EntityManagerInterface $entityManager, Request $request)
    {
        $section=new Section();
        $form= $this->createForm(type:SectionType::class,data:$section);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $entityManager->persist($section);
            $entityManager->flush();
            $this->addFlash('success', 'Created Faculty Successfully');
            return $this->redirect($this->generateUrl(route:'show_section'));
        }
        return $this->render('admin/create_section.html.twig', ['sectionForm'=>$form->createView(),]);
    }

    #[Route('/admin/update_section/{id}', name: 'update_section')]
    public function UpdateSection(EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $section = $entityManager->getRepository(Section::class)->find($id);
        $form= $this->createForm(type:SectionType::class,data:$section);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($section);
            $entityManager->flush();
            $this->addFlash('success', 'Updated Faculty Successfully');
            return $this->redirect($this->generateUrl(route:'show_section'));
        }
        return $this->render('admin/create_section.html.twig', ['sectionForm'=>$form->createView(),]);
    }

    #[Route('/admin/sections', name: 'show_section')]
    public function ViewSections(EntityManagerInterface $entityManager): Response
    {
        $sections = $entityManager->getRepository(Section::class)->findAll();
        if (!$sections) 
        {
            $this->addFlash('error', 'No sections found');
            return $this->render('admin/show_news.html.twig', ['sections' => $sections,]);
            
        }

        return $this->render('admin/show_sections.html.twig', ['sections' => $sections,]);
    }

    #[Route('/admin/delete_section/{id}', name: 'delete_section')]
    public function removeSelection($id, EntityManagerInterface $entityManager):Response
    {
        $section = $entityManager->getRepository(Section::class)->find($id);
        $entityManager->remove($section);
        $entityManager->flush();
        return $this->redirect($this->generateUrl(route:'show_section'));
    }
}
