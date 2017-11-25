<?php

namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use DateTime;
use App\Entity\Review;

class ReviewSubscriber implements EventSubscriber
{
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

    }

}
