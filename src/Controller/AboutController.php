<?php
namespace App\Controller;
use App\Entity\About;
use App\Entity\Section;
use App\Form\AboutType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function about (EntityManagerInterface $entityManager): Response
    {
        $sections = $entityManager->getRepository(Section::class)->findAll();
        $info = $entityManager->getRepository(About::class)->findAll();
        return $this->render('pages/about.html.twig', ['about'=>$info,'sections'=>$sections]);
    }
    
    #[Route('/admin/create_about', name: 'create_about')]
    public function CreateAbout(EntityManagerInterface $entityManager, Request $request)
    {
        $about=new About();
        $form= $this->createForm(type:AboutType::class,data:$about);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $this->addFlash('success', 'About Created');
            $entityManager->persist($about);
            $entityManager->flush();
            return $this->redirect($this->generateUrl(route:'show_about'));
        }
        return $this->render('admin/create_about.html.twig', ['aboutForm'=>$form->createView()]);
    }

    #[Route('/admin/about', name: 'show_about')]
    public function ViewAbout(EntityManagerInterface $entityManager): Response
    {
        $about = $entityManager->getRepository(About::class)->findAll();

        if (!$about) 
        {
            $this->addFlash('error', 'No about info found');
            return $this->render('admin/show_about.html.twig', ['news' => $about,]);
        }

        return $this->render('admin/show_about.html.twig', ['about' => $about,]);
    }

    #[Route('/admin/update_about/{id}', name: 'update_about')]
    public function UpdateAbout(EntityManagerInterface $entityManager, Request $request, int $id): Response
    {
        $about = $entityManager->getRepository(About::class)->find($id);
        $form= $this->createForm(type:AboutType::class,data:$about);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $entityManager->persist($about);
            $entityManager->flush();
            return $this->redirect($this->generateUrl(route:'show_about'));
        }
        return $this->render('admin/create_about.html.twig', ['aboutForm'=>$form->createView()]);
    }

    #[Route('/admin/delete_about/{id}', name: 'delete_about')]
    public function deleteAbout($id,EntityManagerInterface $entityManager):Response
    {
        $about = $entityManager->getRepository(About::class)->find($id);
        $entityManager->remove($about);
        $entityManager->flush();
        return $this->redirect($this->generateUrl(route:'show_about'));
    }
}
