<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HelloController
 * @package App\Controller
 * @Route("/page")
 */
class HelloController extends AbstractController
{
    /**
     * @Route(path="/hi/{name}", name="hello")
     * @param string $name
     * @param Request $request
     * @return Response
     */
    public function hello(string $name, Request $request): Response
    {
        $helloText = "Cześć ".$name;
        $param1 = $request->get('param1', 'Default param value');
        return new Response("<html><body><h1>$helloText</h1><p>$param1</p></body></html>");
    }

    /**
     * @Route(path="/redirect/{action}", requirements={"action"="hello|currentDate"})
     * @param string $action
     * @return RedirectResponse
     * @throws \Exception
     */
    public function moveToAction(string $action): RedirectResponse
    {
        return $this->redirectToRoute($action, ['name'=>'Some name']);
    }

    /**
     * @Route(path="{author}/{page}", requirements={"page" = "\d+"})
     * @param int $page
     * @param string $author
     * @return Response
     */
    public function page(string $author, int $page = 1)
    {
        return new Response("Welcome on page $page for $author");
    }
}