<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FeedbackController extends Controller
{
    /**
     * @Route("/reviews/{id}/like")
     * @Method("PUT")
     */
    public function likeAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $review = $em->getRepository('App:Review')->find($id);

        $review->increaseLikes();

        $em->flush();

        $data = $this->get('serializer')->serialize($review, 'jsonld', ['review']);

        return new Response($data, 200, ['Content-Type' => 'application/ld+json']);
    }

    /**
     * @Route("/reviews/{id}/flag")
     * @Method("PUT")
     */
    public function flagAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $review = $em->getRepository('App:Review')->find($id);

        $review->increaseFlags();

        $em->flush();

        $data = $this->get('serializer')->serialize($review, 'jsonld', ['review']);

        return new Response($data, 200, ['Content-Type' => 'application/ld+json']);
    }
}