<?php

namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use DateTime;
use App\Entity\Review;
use GuzzleHttp\Client;

class ReviewSubscriber implements EventSubscriber
{
    public function __construct($em, $wuser, $wpass){
        $this->em = $em;
        $this->wuser = $wuser;
        $this->wpass = $wpass;
    }

    public function getSubscribedEvents()
    {
        return ['prePersist'];
    }

    public function prePersist(LifecycleEventArgs $args){
        $review = $args->getObject();

        if (!$review instanceof Review) {
            return;
        }

        $review->setCreatedAt(new DateTime('now'));

        $client = new Client();
        //$res = $client->request('GET', 'http://www.google.com');

        $res = $client->request('POST', 'https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone?version=2017-09-21', [
            'auth' => [$this->wuser, $this->wpass],
            'headers'  => ['content-type' => 'text/plain'],
            'body' => $review->getComment()
        ]);


        $tones = json_decode($res->getBody(),true)["document_tone"]["tones"];

        var_dump($tones);die();
//        foreach ($tones as $tone) {
//            $tone["score"];
//            $tone["tone_id"];
//
//
//        }
//        var_dump($tones);
//        die();

    }

}
