<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/admin/user/{id}', name: 'user_show_id')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        if (!$user) 
        {
            throw $this->createNotFoundException( 'No product found for id '.$id );
        }
        return new Response('Check out this user: '.$user->getEmail());
    } 
    
    #[Route('/admin/users', name: 'view_users')]
    public function showUsers(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        if (!$users) 
        {
            return $this->render('admin/show_users.html.twig', ['users' => $users]);
        }

        return $this->render('admin/show_users.html.twig', ['users' => $users]);
    }
    
    #[Route('/admin/update_user/{id}', name: 'update_user')]
    public function UpdateUser(EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $form= $this->createForm(type:UserType::class,data:$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'User Updated');
            return $this->redirect($this->generateUrl(route:'view_users'));
        }
        return $this->render('admin/update_user.html.twig', ['userForm'=>$form->createView(),]);
    }
    #[Route('/admin/delete_user/{id}', name: 'delete_user')]
    public function DeleteUser(EntityManagerInterface $entityManager, User $user, $id)
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirect($this->generateUrl(route:''));
    }
}
