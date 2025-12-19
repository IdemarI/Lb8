<?php

class InvalidAmountException extends Exception
{
    public function __construct(string $message = "Сумма должна быть положительным числом")
    {
        parent::__construct($message);
    }
}