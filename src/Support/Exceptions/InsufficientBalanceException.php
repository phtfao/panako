<?php

namespace Phtfao\Panako\Support\Exceptions;

class InsufficientBalanceException extends BusinessException
{
    public function __construct(
        string $message = self::MSG_INSUFFICIENT_BALANCE_EXCEPTION,
        int $code = self::CODE_INSUFFICIENT_BALANCE_EXCEPTION, 
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
