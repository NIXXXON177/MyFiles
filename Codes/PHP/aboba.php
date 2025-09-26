<?php

class Calculator {
    private $result;

    public function __construct() {
        $this->result = 0;
    }

    public function add($number) {
        $this->result += $number;
    }

    public function subtract($number) {
        $this->result -= $number;
    }

    public function multiply($number) {
        $this->result *= $number;
    }

    public function divide($number) {
        if ($number != 0) {
            $this->result /= $number;
        } else {
            throw new Exception("Деление на ноль запрещено!");
        }
    }

    public function getResult() {
        return $this->result;
    }
}