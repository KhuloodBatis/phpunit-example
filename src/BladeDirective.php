<?php



class BladeDirective
{


    public function __construct(RussianCache $cache)
    {
        $this->cache = $cache;
    }

    public function setUp($key)
    {
      $this->cache->has(
        $this->normalizeKey($key)
      );

    }

    public function normalizeKey($item)
    {
       if(is_object($item) && method_exists($item,'getCachKey'))
       {
         return $item->getCachKey();
       }

       if(is_array($item))
       {
         return md5(implode($item)); // ['one','two'] // one two 

       }
       return $item ;
    }
   
}
