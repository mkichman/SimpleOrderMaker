<?php


namespace App\Events;


final class ColorSelected
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name) { }
}
