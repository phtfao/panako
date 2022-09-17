<?php

namespace Phtfao\Panako\Support\Exceptions;

class SelfTransferException extends BusinessException
{
    public function __construct(
        string $message = self::MSG_SELF_TRANSFER_EXCEPTION,
        int $code = self::CODE_SELF_TRANSFER_EXCEPTION, 
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
