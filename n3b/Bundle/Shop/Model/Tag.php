<?php

namespace n3b\Bundle\Shop\Model;

abstract class Tag {
    protected function __construct()
    {
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function generateSlugStr(array $slugs)
    {
        if($this->isInSlugs($slugs))
            $slugs = \array_diff($slugs, array($this->slug));
        else
           $slugs[] = $this->slug;

        $first = \array_shift($slugs);
        \sort($slugs);
        \array_unshift($slugs, $first);

        return \implode(',', $slugs);
    }

    public function isInSlugs(array $slugs)
    {
        if(isset($this->inSlugs))
            return $this->inSlugs;

        return $this->inSlugs = \in_array($this->slug, $slugs);
    }
}
