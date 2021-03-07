<?php
class Odcinek{
    private $x = null;
    private $y = null;
    private $x1 = null;
    private $y1 = null;

    public function __construct($x = null, $y = null, $x1 = null, $y1 = null){
        $array = range(-100,100);
        // musialem dodac != null, bo co ciekawe w array znajduje sie rowniez null.
        if ($x and $x1 and $y and $y1 != null and in_array($x, $array) and in_array($x1, $array) and in_array($y, $array) and in_array($y1, $array)){
//        if (is_int($x) or is_int($x1) or is_int($y) or is_int($y1)){
            $this->x = $x;
            $this->y = $y;
            $this->x1 = $x1;
            $this->y1 = $y1;
        }
        else{
            $this->x = rand(-100, 100);
            $this->y = rand(-100, 100);
            $this->x1 = rand(-100, 100);
            $this->y1 = rand(-100, 100);
        }
    }

    public function __destruct(){
    }

    public function liczDlugosc(){
        return sqrt(pow(($this->x1-$this->x), 2)+pow(($this->y1-$this->y), 2));
    }
}