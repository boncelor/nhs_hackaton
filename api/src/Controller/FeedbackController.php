<?php

namespace App\Controller;

use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FeedbackController extends Controller
{
    /**
     * Start a transaction
     *
     * @Route("/reviews/{id}/like")
     * @Method("PUT")
     */
    public function likeAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $review = $em->getRepository('App:Review')->find($id);

        $review->increaseLikes();

        $em->flush();

        $data = $this->get('serializer')->serialize($review, 'jsonld', ['transaction']);

        return new Response($data, 200, ['Content-Type' => 'application/ld+json']);
    }

    /**
     * Start a transaction
     *
     * @Route("/reviews/{id}/flag")
     * @Method("PUT")
     */
    public function flagAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $review = $em->getRepository('App:Review')->find($id);

        $review->increaseFlags();

        $em->flush();

        $data = $this->get('serializer')->serialize($review, 'jsonld', ['transaction']);

        return new Response($data, 200, ['Content-Type' => 'application/ld+json']);
    }
}