<?php

namespace  App\Listener;

use App\Entity\Property;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{

    /**
     * @var CacheManager
     */
    private $cacheManager;

    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
          'preRemove',
          'preUpdate'
        ];
    }

    public function preRemove(LifecycleEventArgs $args){
        $entity = $args->getEntity();

        if(!$entity instanceof Property)
            return;

        $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));

    }

    public function preUpdate(PreUpdateEventArgs $args){

        //Récupère l'entité.
        $entity = $args->getEntity();

        //Si ce n'est pas une propriété, alors on ne fait rien.
        if(!$entity instanceof Property)
            return;

        //Si une image a été uploadée lors de l'édition d'une propriété, alors on enlève l'image de l'entité X avant d'updater.
        if($entity->getImageFile() instanceof UploadedFile) {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
        }

    }

}