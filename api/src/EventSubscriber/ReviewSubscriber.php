<?php

namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Review;

class ReviewSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return ['preCreate'];
    }

    public function preCreate(LifecycleEventArgs $args){
        $resource = $args->getObject();

        if (!$resource instanceof Review) {
            return;
        }
die();
        if($resource->getActive()==true){
            $hcpAvailableMsg = $this->hcpMsgBuilder->build($resource->getId());

        }
    }

}
