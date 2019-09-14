<?php


namespace App\Controller;


use App\Service\LuckyNumber;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends Controller
{
    /**
     * @Route(path="/hi/{name}", name="hello")
     * @param string $name
     * @param Request $request
     * @param LoggerInterface $logger
     * @return Response
     */
    public function hello(string $name, Request $request, LoggerInterface $logger): Response
    {
        $luckyNumber = $this->container->get(LuckyNumber::class);
        $number = $luckyNumber->getNumber();
        $personNames = ['Tomka', 'Ani', 'Magdy'];
        $logger->debug("Powitany: ". $name);
        return $this->render('hello/hi.html.twig', [
            'number'=>$number,
            'name' => $name,
            'personNames' => $personNames, 'show' => true
        ]);
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