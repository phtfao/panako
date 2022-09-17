<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Phtfao\Panako\Core\User\UserService;
use Phtfao\Panako\Broker\Model\Transaction;
use Phtfao\Panako\Support\Repository\UserRepository;
use Phtfao\Panako\Core\Transaction\TransactionService;
use Phtfao\Panako\Support\Exceptions\BusinessException;
use Phtfao\Panako\Support\Exceptions\SelfTransferException;
use Phtfao\Panako\Support\Repository\TransactionRepository;
use Phtfao\Panako\Support\Exceptions\NotAuthorizedException;
use Phtfao\Panako\Support\Exceptions\InsufficientBalanceException;


class TransactionServiceTest extends TestCase
{
    //use DatabaseTransactions;

    private TransactionService $service;
    private TransactionRepository $transactionRepositoryMock;
    private UserService $userService;
    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        //$this->repository = new TransactionRepository(new Transaction());
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $this->transactionRepositoryMock = $this->createMock(TransactionRepository::class);


        //$this->userService = new UserService(new UserRepository(new User()));
        $this->userService = new UserService($userRepositoryMock);
        $this->service = new TransactionService($this->transactionRepositoryMock, $this->userService);

        //dd($this->service, $this->repositoryMock, $this->userService);
    }
    public function Store()
    {
        $transactionRepository = $this->createMock(TransactionRepository::class);
        $transactionRepository->expects($this->once())
            ->method('store')
            ->with($this->equalTo(['amount' => 100, 'user_id' => 1]))
            ->willReturn(new Transaction(['amount' => 100, 'user_id' => 1]));
        $transactionService = new TransactionService($transactionRepository, $this->createMock(UserService::class));
        $transaction = $transactionService->store(['amount' => 100, 'user_id' => 1]);
        //dd($transaction);
        $this->assertEquals(100, $transaction->amount);
        $this->assertEquals(1, $transaction->user_id);
    }

    public function testCheckPayerCanTransferDeveLancarExcecaoParaCategoryLojista()
    {
        $this->expectException(BusinessException::class);
        $payerAccount = new \StdClass();
        $payerAccount->category = 'L';
        $this->service->checkPayerCanTransfer($payerAccount);
    }

    public function testCheckSufficientBalanceDeveLancarExcecaoParaValorMaiorQueBalance()
    {
        $this->expectException(InsufficientBalanceException::class);
        $payerAccount = new \StdClass();
        $payerAccount->balance = 100;
        $this->service->checkSufficientBalance($payerAccount, 200);
    }

    public function testCheckTransferForItselfDeveLancarExcecaoParaMesmoPayerPayee()
    {
        $this->expectException(SelfTransferException::class);
        $payerAccount = new \StdClass();
        $payerAccount->id = 1;
        $payeeAccount = new \StdClass();
        $payeeAccount->id = 1;
        $this->service->checkTransferForItself($payerAccount, $payeeAccount);
    }

    public function testCheckValueDeveLancarExcecaoParaValorMenorQueZero()
    {
        $this->expectException(BusinessException::class);
        $this->service->checkValue(-1);
    }

    public function CheckAthorizationDeveLancarExcecaoParaUsuarioNaoAutorizado()
    {
        $this->expectException(NotAuthorizedException::class);
        $this->service->checkAthorization();
    }


}
