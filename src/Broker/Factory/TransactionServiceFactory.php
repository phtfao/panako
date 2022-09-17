<?php

namespace Phtfao\Panako\Broker\Factory;


use Psr\Container\ContainerInterface;
use Phtfao\Panako\Core\User\UserService;
use Phtfao\Panako\Broker\Model\Transaction;
use Phtfao\Panako\Core\Transaction\TransactionService;
use Phtfao\Panako\Support\Repository\TransactionRepository;



class TransactionServiceFactory
{
    public function __invoke(ContainerInterface $container) : TransactionService
    {
        $transactionRepository = new TransactionRepository(new Transaction());
        assert($transactionRepository instanceof TransactionRepository);

        $userService = $container->get(UserService::class);
        assert($userService instanceof UserService);

        return new TransactionService($transactionRepository, $userService);
    }
}