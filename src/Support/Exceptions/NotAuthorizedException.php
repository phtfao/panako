<?php

namespace Phtfao\Panako\Support\Exceptions;

class NotAuthorizedException extends BusinessException
{
    public function __construct(
        string $message = self::MSG_NOT_AUTHORIZED_EXCEPTION,
        int $code = self::CODE_NOT_AUTHORIZED_EXCEPTION, 
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
