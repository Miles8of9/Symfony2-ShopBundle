<?php

namespace n3b\Bundle\Shop\Exchange;

use n3b\Bundle\Shop\Exchange\Interfaces\TagInterface;
use n3b\Bundle\Shop\Entity\Tag;

class TagImporter
{
    protected $em;
    protected $type;

    public function __construct($em)
    {
        $this->em = $em;
        $this->types = $this->em->getRepository('n3bShopBundle:TagType')->findAll();
    }

    public function import(TagInterface $impTag, $references = false)
    {
        if(!$tag = $this->em->getRepository('n3bShopBundle:Tag')->findOneBy(array('external' => $impTag->getExternal(), 'type' => $impTag->getType($this->types)->getId()))) {
            $tag = new Tag();
            $tag->setExternal($impTag->getExternal());
            $tag->setType($impTag->getType($this->types));
            $this->em->persist($tag);
        }

        if(!$references) {

            $tag->setTitle($impTag->getTitle());
            $tag->setActive($impTag->getActive());
            
        } else {

            if(\is_null($impTag->getParentId()))
                $tag->removeParent();
            else
                $tag->setParent($this->em->getRepository('n3bShopBundle:Tag')->findOneBy(array('external' => $impTag->getParentId(), 'type' => $impTag->getType($this->types)->getId())));
        }

        $tag->slugify();
    }
}
