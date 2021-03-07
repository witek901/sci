<?php
class Osoba{
    private $name = null;
    private $surname = null;
    private $sex = null;
    private $birthdate = null;
    private $phonenumber = null;


    public function __construct($name, $surname, $sex = "DEFAULT", $phonenumber = "DEFAULT", $birthdate = "DEFAULT"){
        $this->name = $name;
        $this->surname = $surname;
        $this->sex = $sex;
        $this->phonenumber = $phonenumber;
        $this->birthdate = $birthdate;
    }

    //funkcja destruktora
    public function __destruct(){
        // komentarz
    }
    public function getPhoneNumber(){
        return $this->phonenumber;
    }

    public function setPhoneNumber($phonenumber){
        if (strlen($phonenumber) == 9 && is_numeric($phonenumber)){
            $this->phonenumber = $phonenumber;
        }
    }

    public function setSurname($surname){
        if (strlen($surname) >= 2 &&!is_numeric($surname)){
            $this->surname = $surname;
        }
    }

    private function days($birthdate){
        $datediff = time() - strtotime($this->birthdate);
        $daysAmount = round($datediff / (60 * 60 * 24));
        return $daysAmount;
    }

    public function getInfo(){
        if ($this->sex == "m"){
            $newText = 'I\'m Mr %1$s. %1$s %2$s. <br>';
        }
        elseif ($this->sex == "f"){
            $newText = 'I\'m Mrs %1$s. %1$s %2$s. <br>';
        }
        else{
            $newText = 'I\'m %1$s. %1$s %2$s. <br>';
        }

        if ($this->birthdate != "DEFAULT"){
            $daysAmount = $this->days($this->birthdate);
            $text = 'I was born on %3$s, and have already lived %4$s days <br> <br>
                My phone number is %5$s. <br>
                Call me if You came to Paris.';
            $a = sprintf($newText.$text, $this->name, $this->surname, $this->birthdate, $daysAmount, $this->phonenumber);
            return $a;
        }
        else{
            $text = 'I\'m %1$s. %1$s %2$s. <br> <br>
                My phone number is %4$s. <br>
                Call me if You came to Paris.';
            $a = sprintf($newText.$text, $this->name, $this->surname, $this->birthdate, $this->phonenumber);
            return $a;
        }
    }

    public function getDays(){
        if ($this->birthdate != "DEFAULT"){
            return $this->days($this->birthdate);
        }
    }
}