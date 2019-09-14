<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrentDateController
{
    /**
     * @Route(path="/index", name="currentDate", methods={"POST"})
     * @return Response
     * @throws
     */
    public function currentDate(): Response
    {
        $currentDate = new \DateTime();

        return $this->getDateResponse('Current date', $currentDate);
    }

    /**
     * @Route(path="/index", methods={"GET"})
     * @return Response
     * @throws \Exception
     */
    public function tomorrowDate(): Response
    {
        $tomorrow = new \DateTime();
        $tomorrow->add(new \DateInterval('P1D'));
        return  $this->getDateResponse('Tomorrow day', $tomorrow);
    }

    private function getDateResponse(string $title, \DateTime $dateTime)
    {
        $format = $dateTime->format(DATE_ATOM);
        $html = <<< EOT
        <html>
        <body>
            <h1>$title</h1>
            <p>$format</p>
        </body>
        </html>
EOT;

        return new Response($html);
    }

}