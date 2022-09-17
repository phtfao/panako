<?php

namespace Phtfao\Panako\Support\Exceptions;

class BusinessException extends \Exception
{
    const MSG_DEFAULT = 'Erro ao realizar operação.';
    const MSG_CANT_TRANSFER_EXCEPTION = 'Usuario bloqueado para transferencias.';
    const MSG_INSUFFICIENT_BALANCE_EXCEPTION = 'Saldo insuficiente.';
    const MSG_NOT_AUTHORIZED_EXCEPTION = 'Autorização negada.';
    const MSG_NOT_FOUND_EXCEPTION = 'Registro não encontrado.';
    const MSG_SELF_TRANSFER_EXCEPTION = 'Não é possível realizar transferência para si mesmo.';
    const CODE_DEFAULT = 428;
    const CODE_CANT_TRANSFER_EXCEPTION = 428;
    const CODE_INSUFFICIENT_BALANCE_EXCEPTION = 428;
    const CODE_NOT_AUTHORIZED_EXCEPTION = 401;
    const CODE_NOT_FOUND_EXCEPTION = 404;
    const CODE_SELF_TRANSFER_EXCEPTION = 428;

    public function __construct(
        string $message = self::MSG_DEFAULT,
        int $code = self::CODE_DEFAULT,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
