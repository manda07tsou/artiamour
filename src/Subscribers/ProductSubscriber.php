<?php

namespace App\Subscribers;

use App\Entity\Product;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ProductSubscriber implements EventSubscriber{
    private $cache;
    private $helper;

    public function __construct(CacheManager $cache, UploaderHelper $helper)
    {
        $this->cache = $cache;
        $this->helper = $helper;
    }

    public function getSubscribedEvents()
    {
        return[
            'preRemove',
            'preUpdate'
        ];
    }

    public function preUpdate(LifecycleEventArgs $args){
        $entity = $args->getEntity();

        if(!$entity instanceof Product){
            return;
        }
        
        if(!$entity->getImage() instanceof UploadedFile){
            return;
        }

        $this->cache->remove($this->helper->asset($entity, 'image'));
    }

    public function preRemove(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        if(!$entity instanceof Product){
            return;
        }
        $this->cache->remove($this->helper->asset($entity, 'image'));
    }
}