<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\User;
use App\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package App\Controller
 * @Route(path="/category")
 */
class CategoryController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route(path="/create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager):Response
    {
        $category = new Category('');


        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_category_list');
        }

        return $this->render('category/create.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/list")
     */
    public function list(EntityManagerInterface $entityManager):Response
    {
        $repository = $entityManager->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('category/list.html.twig', [
            'categories'=>$categories,
        ]);
    }
}