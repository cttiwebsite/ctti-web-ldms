<?php
namespace App\Controller;
use App\Entity\News;
use App\Form\NewsType;
use App\Entity\Section;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'news')]
    public function events(EntityManagerInterface $entityManager): Response
    {
        $news = $entityManager->getRepository(News::class)->findAll();
        $sections = $entityManager->getRepository(Section::class)->findAll();
        return $this->render('pages/news.html.twig',['news' => $news, 'sections'=>$sections]);
    }

    #[Route('/news/{slug}', name: 'view_news_item')]
    public function ViewNewsItem(EntityManagerInterface $entityManager, string $slug): Response
    {
        $news = $entityManager->getRepository(News::class)->findByHeading($slug);
        $sections = $entityManager->getRepository(Section::class)->findAll();
        if (!$news) 
        {
            $this->addFlash('error', 'No News Found');
            return $this->render('pages/news.html.twig', ['news' => $news,]);
        }
        return $this->render('pages/view_news.html.twig',['news' => $news, 'sections'=>$sections]);
    }

    #[Route('/admin/add_news', name: 'create_news')]
    public function createNews(EntityManagerInterface $entityManager, Request $request): Response
    {
        $news=new News();
        $form= $this->createForm(type:NewsType::class,data:$news);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $this->addFlash('success', 'News Created');
            $entityManager->persist($news);
            $entityManager->flush();
        }
        return $this->render('admin/create_news.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/admin/update_news/{id}', name: 'update_news')]
    public function UpdateNews(EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $news = $entityManager->getRepository(News::class)->find($id);
        $form= $this->createForm(type:NewsType::class,data:$news);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($news);
            $entityManager->flush();
            $this->addFlash('success', 'News Updated');
            return $this->redirect($this->generateUrl(route:'show_news'));
        }
        return $this->render('admin/update_news.html.twig', ['form'=>$form->createView(),]);
    }

    #[Route('/admin/news', name: 'show_news')]
    public function ViewNews(EntityManagerInterface $entityManager): Response
    {
        $news = $entityManager->getRepository(News::class)->findAll();

        if (!$news) 
        {
            $this->addFlash('error', 'No News Found');
            return $this->render('admin/show_news.html.twig', ['news' => $news,]);
        }

        return $this->render('admin/show_news.html.twig', ['news' => $news,]);
    }

    #[Route('/admin/delete_news/{id}', name: 'delete_news')]
    public function removeNews($id,EntityManagerInterface $entityManager):Response
    {
        $news = $entityManager->getRepository(News::class)->find($id);
        $entityManager->remove($news);
        $entityManager->flush();
        return $this->redirect($this->generateUrl(route:'show_news'));
    }

}
