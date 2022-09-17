<?php

namespace Phtfao\Panako\Support\Exceptions;

class CantTransferException extends BusinessException
{
    public function __construct(
        string $message = self::MSG_CANT_TRANSFER_EXCEPTION,
        int $code = self::CODE_CANT_TRANSFER_EXCEPTION, 
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
