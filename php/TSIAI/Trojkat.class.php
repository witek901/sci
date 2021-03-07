<?php
class Trojkat{
    public $a = null;
    public $h = null;

    public function __construct(){
        $this->a = rand(0, 100);
        $this->h = rand(0, 100);
    }

    public function __destruct(){
    }

    public function poleTrojkata(){
        return ($this->a+$this->h)/2;
    }

    public function getInfo(){
        $text = 'Trójkąt o podstawie %1$s i wysokości %2$s ma pole powierzchni %3$s.<br>';
        $a = sprintf($text, $this->a, $this->h, $this->poleTrojkata());
        return $a;
    }
}