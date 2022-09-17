<?php

namespace Phtfao\Panako\Core\Transaction;

use Phtfao\Panako\Core\User\UserService;
use Phtfao\Panako\Support\Exceptions\BusinessException;
use Phtfao\Panako\Core\Authorization\AuthorizationService;
use Phtfao\Panako\Support\Exceptions\CantTransferException;
use Phtfao\Panako\Support\Exceptions\SelfTransferException;
use Phtfao\Panako\Support\Repository\TransactionRepository;
use Phtfao\Panako\Support\Exceptions\NotAuthorizedException;
use Phtfao\Panako\Support\Exceptions\InsufficientBalanceException;
use Phtfao\Panako\Support\Contracts\TransactionRepositoryInterface;

class TransactionService
{
    public function __construct(
        private TransactionRepositoryInterface $repository,
        private UserService $userService
    ) {}

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function get(int $idTransaction)
    {
        return $this->repository->get($idTransaction);
    }

    public function transfer(int $payer, int $payee, float $value): bool
    {
        $this->repository->beginTransaction();
        try {

            $payerAccount = $this->userService->getOrFail($payer);
            $payeeAccount = $this->userService->getOrFail($payee);

            $this->checkPayerCanTransfer($payerAccount);
            $this->checkSufficientBalance($payerAccount, $value);
            $this->checkTransferForItself($payerAccount, $payeeAccount);
            $this->checkValue($value);
            $this->checkAthorization();

            $payerAccount->withdraw($value);
            $payeeAccount->deposit($value);

            $payerAccount->save();
            $payeeAccount->save();

            $this->repository->transfer($payerAccount->id, $payeeAccount->id, $value);
            $this->repository->commit();

            $this->notifyPayee($payeeAccount);
        } catch (\Exception $e) {
            $this->repository->rollBack();
            throw $e;
        }
        return true;
    }

    public function checkPayerCanTransfer($payerAccount): void
    {
        if ($payerAccount->category != 'C') {
            throw new CantTransferException();
        }
    }

    public function checkSufficientBalance($payerAccount, float $value): void
    {
        if ($payerAccount->balance < $value) {
            throw new InsufficientBalanceException();
        }
    }

    public function checkTransferForItself($payer, $payee): void
    {
        if ($payer->id == $payee->id) {
            throw new SelfTransferException();
        }
    }

    public function checkValue(float $value): void
    {
        if ($value <= 0) {
            throw new BusinessException('Valor inválido.');
        }
    }

    public function checkAthorization(): void
    {
        if (!AuthorizationService::isAuthorized()) {
            throw new NotAuthorizedException();
        }
    }

    public function notifyPayee($user): void
    {
        //chamar serviço de fila de notificação
    }
}