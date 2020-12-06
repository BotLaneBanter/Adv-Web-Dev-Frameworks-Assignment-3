<?php

namespace QuwisSystem\Framework;

interface Observable{

public function attach(Observer $observer);
public function detach(Observer $observer);
public function notify();

}

?>