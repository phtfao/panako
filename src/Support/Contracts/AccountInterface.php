<?php

namespace Phtfao\Panako\Support\Contracts;

interface AccountInterface
{
    public function deposit(float $amount): float;
    public function withdraw(float $amount): float;
}