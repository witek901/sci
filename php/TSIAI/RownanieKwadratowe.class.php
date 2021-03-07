<?php


class RownanieKwadratowe
{
    private $a;
    private $b;
    private $c;

    public function __construct($a, $b, $c){
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function liczDelta(){
        $delta = $this->b*$this->b-4*$this->a*$this->c;
        return $delta;
    }

    public function liczRownanie(){
        $delta = $this->liczDelta();
        $roz = array();
        if ($delta > 0){
            $x1=(-$this->b-sqrt($delta))/2/$this->a;
            $x2=(-$this->b+sqrt($delta))/2/$this->a;
            $roz[0] = $x1;
            $roz[1] = $x2;
        } elseif ($delta==0) {
            $x = -$this->b / (2 * $this->a);
            $roz[0] = $x;
            $roz[1] = $x;
        } else{
            return false;
        }
        return array($roz);
    }

    public function rysujWykres(){

    }
}