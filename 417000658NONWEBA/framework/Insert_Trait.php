<?php

namespace QuwisSystem\Framework;

trait Insert_Trait{

    //Takes data as name value pairs in an array where the name is the associative
    //Array index. E.g: data['foo'] = 'bar';
    abstract public function insert(array $data);

}

?>