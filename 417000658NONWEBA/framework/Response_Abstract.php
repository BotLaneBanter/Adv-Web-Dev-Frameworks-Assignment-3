<?php 

namespace QuwisSystem\Framework;

abstract class Response_Abstract{

    protected $data = [];

    public function showAllData(string $sep = '<br>') : string{

        return implode($sep, $this->data);

    }

    abstract public function addEntries(array $entries) : bool;

    abstract public function showEntry(int $i) : string;

    abstract public function showEntries(int $start, int $end) : string;

}

?>