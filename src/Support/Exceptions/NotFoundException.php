<?php

namespace Phtfao\Panako\Support\Exceptions;

class NotFoundException extends BusinessException
{
    public function __construct(
        string $message = self::MSG_NOT_FOUND_EXCEPTION,
        int $code = self::CODE_NOT_FOUND_EXCEPTION, 
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
