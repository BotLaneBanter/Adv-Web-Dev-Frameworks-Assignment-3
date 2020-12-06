<?php 

namespace QuwisSystem\Framework;

abstract class GenCollection
{
 protected $mapper;
 protected $total = 0;
 protected $raw = [];
 private $objects = [];

   public function __construct(array $raw = [], Mapper $mapper = null)
   {

   $this->raw = $raw;
   $this->total = count($raw);

   if (count($raw) && is_null($mapper)) {
   throw new AppException("Need A Mapper To Generate Objects");
   }

   $this->mapper = $mapper;

   }

   public function add(DomainObject $object)
   {

   $class = $this->targetClass();

   if (! ($object instanceof $class )) {
      throw new AppException("This Is A {$class} Collection");
   }

   $this->notifyAccess();
   $this->objects[$this->total] = $object;
   $this->total++;

   }
   public function getGenerator()
   {
      
      for ($x = 0; $x < $this->total; $x++) {
         yield $this->getRow($x);
      }

   }

 protected function notifyAccess()
   {
   // deliberately left blank!
   }

   private function getRow($num)
   {

      $this->notifyAccess();

      if ($num >= $this->total || $num < 0) {
         return null;
      }
      if (isset($this->objects[$num])) {
         return $this->objects[$num];
      }
      if (isset($this->raw[$num])) {
         $this->objects[$num] = $this->mapper->createObject($this->raw[$num]);
         return $this->objects[$num];
      }

   }

   //Specifies which class objects are accepted by the collection
   abstract public function targetClass(): string;

}

?>