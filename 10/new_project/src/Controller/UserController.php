<?php


namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package App\Controller
 * @Route(path="/user")
 */
class UserController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route(path="/create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager):Response
    {
        if ('POST' === $request->getMethod()){
            $user = new User($request->get('name', ''));
            $user->setSurname($request->get('surname'));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_list');
        }else {
            $user = new User('');
        }
        return $this->render('user/create.html.twig', [
            'user'=>$user,
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/list", name="user_list")
     */
    public function list(EntityManagerInterface $entityManager):Response
    {
        $repository = $entityManager->getRepository(User::class);
        $users = $repository->findAll();
        return $this->render('user/list.html.twig', [
            'users'=>$users,
        ]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/delete/{id}")
     */
    public function delete(int $id, EntityManagerInterface $entityManager):Response
    {
        $repository = $entityManager->getRepository(User::class);
        $user = $repository->find($id);
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('user_list');
    }

    /**
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route(path="/edit/{id}")
     */
    public function edit(User $user, EntityManagerInterface $entityManager, Request $request):Response
    {
        if ('POST' === $request->getMethod()){
            $user->setName($request->get('name', ''));
            $user->setSurname($request->get('surname', ''));
            $entityManager->flush();

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', [
            'user'=>$user,
        ]);

    }
}