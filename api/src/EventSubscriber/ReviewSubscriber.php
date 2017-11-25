<?php

namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use DateTime;
use App\Entity\Review;
use App\Entity\ReviewSentimentLog;
use GuzzleHttp\Client;

class ReviewSubscriber implements EventSubscriber
{
    public function __construct($wuser, $wpass){
        $this->wuser = $wuser;
        $this->wpass = $wpass;
    }

    public function getSubscribedEvents()
    {
        return ['prePersist'];
    }

    public function prePersist(LifecycleEventArgs $args){
        $review = $args->getObject();
        $em = $args->getObjectManager();

        if (!$review instanceof Review) {
            return;
        }

        $review->setCreatedAt(new DateTime('now'));

        $client = new Client();

        $res = $client->request('POST', 'https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone?version=2017-09-21', [
            'auth' => [$this->wuser, $this->wpass],
            'headers'  => ['content-type' => 'text/plain'],
            'body' => $review->getComment()
        ]);


        $tones = json_decode($res->getBody(),true)["document_tone"]["tones"];

        $bestTone = null;
        $bestToneScore = 0;

        foreach ($tones as $tone) {

            $reviewLog = new ReviewSentimentLog($review, $tone['score'], $tone['tone_id']);
            $em->persist($reviewLog);

            if($tone['score']>$bestToneScore) {
                $bestTone = $tone;
            }
        }

        $review->setSentiment($bestTone['tone_id']);

    }

}
