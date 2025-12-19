<?php
class InsufficientFundsException extends Exception
{
    public function __construct(string $message = "Недостаточно средств на счете")
    {
        parent::__construct($message);
    }
}