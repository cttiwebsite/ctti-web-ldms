<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{ 
     #[Route('/events', name: 'events')]
    public function events(): Response
    {
        return $this->render('pages/events.html.twig');
    }

    #[Route('/admin/add_event', name: 'create_event')]
    public function createEvent(EntityManagerInterface $entityManager, Request $request): Response
    {
        $event=new Event();
        $form= $this->createForm(type:EventType::class,data:$event);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $this->addFlash('success', 'News Created');
            $entityManager->persist($event);
            $entityManager->flush();
        }
        return $this->render('admin/create_event.html.twig', ['eventForm'=>$form->createView()]);
    }

    #[Route('/admin/update_event/{id}', name: 'update_event')]
    public function UpdateEvent(EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $event = $entityManager->getRepository(Event::class)->find($id);
        $form= $this->createForm(type:EventType::class,data:$event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($event);
            $entityManager->flush();
            $this->addFlash('success', 'News Updated');
            return $this->redirect($this->generateUrl(route:'show_events'));
        }
        return $this->render('admin/update_event.html.twig', ['eventForm'=>$form->createView(),]);
    }

    #[Route('/admin/events', name: 'show_events')]
    public function ViewEvents(EntityManagerInterface $entityManager): Response
    {
        $events = $entityManager->getRepository(Event::class)->findAll();

        if (!$events) 
        {
            $this->addFlash('error', 'No Events Found');
            return $this->render('admin/show_events.html.twig', ['events' => $events,]);
        }

        return $this->render('admin/show_events.html.twig', ['news' => $events,]);
    }

    #[Route('/admin/delete_events/{id}', name: 'delete_event')]
    public function removeEvents($id,EntityManagerInterface $entityManager):Response
    {
        $event = $entityManager->getRepository(Event::class)->find($id);
        $entityManager->remove($event);
        $entityManager->flush();
        return $this->redirect($this->generateUrl(route:'show_events'));
    }
}
