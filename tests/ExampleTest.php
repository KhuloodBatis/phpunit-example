<?php 
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
  private $prophet;
  private $cach ;
   /** @test */
    function test_it_normalizes_a_string_for_the_cache_key()
    {
      $prophet = new Prophecy\Prophet;
      $cache = $prophet->prophesize(RussianCache::class);
      $directive = new BladeDirective($cache->reveal());
     
      $cache->has('cache-key')->shouldBeCalled();
      $directive->setUp('cache-key');
    }

    function test_it_normalizes_a_cacheable_model_for_the_cache_key()
    {
      $prophet = new Prophecy\Prophet;
      $cache = $prophet->prophesize(RussianCache::class);
      $directive = new BladeDirective($cache->reveal());
     
      $cache->has('stub-cache-key')->shouldBeCalled();
      $directive->setUp(new ModelStub);
    }

    function test_it_normalizes_an_array_for_the_cache_key()
    {
      $prophet = new Prophecy\Prophet;
      $cache = $prophet->prophesize(RussianCache::class);
      $directive = new BladeDirective($cache->reveal());
      $item = ['foo','bar'];
      $cache->has(md5('foobar'))->shouldBeCalled();
      $directive->setUp($item);
    }

}

    
class ModelStub
{

public function getCecheKey()
{
  return 'stub-cache-key';
}
}