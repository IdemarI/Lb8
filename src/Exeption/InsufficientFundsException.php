<?php

namespace mrmzn\lb8\Exception;
use Exception;

class InsufficientFundsException extends Exception
{
    public function __construct(string $message = "Недостаточно средств на счете")
    {
        parent::__construct($message);
    }
}