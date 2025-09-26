<?php

class Cat {
    public $breed;
    public $color;
    public $age;

    public function __construct($breed, $color, $age) {
        $this->breed = $breed;
        $this->color = $color;
        $this->age = $age;
    }

    public function makeSound() {
        echo "Мяу!\n";
    }

    public function showInfo() {
        echo "Порода: $this->breed, Окрас: $this->color, Возраст: $this->age лет(года)\n";
    }
}

class Dog extends Cat {
    public $barkType;

    public function __construct($breed, $color, $age, $barkType) {
        parent::__construct($breed, $color, $age);
        $this->barkType = $barkType;
    }

    public function makeSound() {
        echo "Гав! $this->barkType!\n";
    }

    public function showInfo() {
        parent::showInfo();
        echo "Тип лая: $this->barkType\n";
        echo "------------------------\n";
    }
}


$cat1 = new Cat("Сиамская", "Рыжий", 3);
$cat1->makeSound();
$cat1->showInfo();

$cat2 = new Cat("Персидская", "Белый", 5);
$cat2->makeSound();
$cat2->showInfo();

$cat3 = new Cat("Дворняга", "Серый", 2);
$cat3->makeSound();
$cat3->showInfo();

echo "\n\n=== СОБАКИ ===\n\n";

$dog1 = new Dog("Лабрадор", "Чёрный", 4, "дружелюбно гавкает");
$dog1->makeSound();
$dog1->showInfo();

$dog2 = new Dog("Такса", "Рыжий", 6, "резко лает");
$dog2->makeSound();
$dog2->showInfo();

$dog3 = new Dog("Овчарка", "Чёрно-коричневый", 3, "громко лает");
$dog3->makeSound();
$dog3->showInfo();