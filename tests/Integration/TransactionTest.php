<?php

namespace Tests\Integration;

use Tests\TestCase;
use Phtfao\Panako\Support\Exceptions\BusinessException;

class TransactionTest extends TestCase
{
    const TRANSACTION_URL = '/transfer';

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:refresh');
        $this->artisan('db:seed');
    }

    public function testTransferirComSucesso()
    {
        $this->post(self::TRANSACTION_URL, [
            'payer_id' => 1,
            'payee_id' => 2,
            'value' => 100
        ]);
        $this->seeStatusCode(201);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
        $this->assertEquals('success', $this->response->getData()->status);
        $this->assertEquals(
            'Transferência realizada com sucesso.', 
            $this->response->getData()->message
        );
    }

    public function testTransferirSemSaldoSuficienteDeveRetornarStatus428()
    {
        $this->post(self::TRANSACTION_URL, [
            'payer_id' => 1,
            'payee_id' => 2,
            'value' => 100000
        ]);
        $this->seeStatusCode(BusinessException::CODE_INSUFFICIENT_BALANCE_EXCEPTION);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
        $this->assertEquals(
            'error',
            $this->response->getData()->status
        );
        $this->assertEquals(
            BusinessException::MSG_INSUFFICIENT_BALANCE_EXCEPTION,
            $this->response->getData()->message
        );
    }

    public function testTransferirComPayerInexistenteDeveRetornarStatus404()
    {
        $this->post(self::TRANSACTION_URL, [
            'payer_id' => 100,
            'payee_id' => 2,
            'value' => 100
        ]);
        $this->seeStatusCode(BusinessException::CODE_NOT_FOUND_EXCEPTION);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
        $this->assertEquals(
            'error',
            $this->response->getData()->status
        );
        $this->assertEquals(
            BusinessException::MSG_NOT_FOUND_EXCEPTION,
            $this->response->getData()->message
        );
    }

    public function testTransferirComPayeeInexistenteDeveRetornarStatus404()
    {
        $this->post(self::TRANSACTION_URL, [
            'payer_id' => 1,
            'payee_id' => 100,
            'value' => 100
        ]);
        $this->seeStatusCode(BusinessException::CODE_NOT_FOUND_EXCEPTION);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
        $this->assertEquals(
            'error',
            $this->response->getData()->status
        );
        $this->assertEquals(
            BusinessException::MSG_NOT_FOUND_EXCEPTION,
            $this->response->getData()->message
        );
    }

    public function testTransferirComValorNegativoDeveRetornarStatus428()
    {
        $this->post(self::TRANSACTION_URL, [
            'payer_id' => 1,
            'payee_id' => 2,
            'value' => -100
        ]);
        $this->seeStatusCode(BusinessException::CODE_DEFAULT);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
        $this->assertEquals(
            'error',
            $this->response->getData()->status
        );
        $this->assertEquals(
            'Valor inválido.',
            $this->response->getData()->message
        );
    }

    public function testTransferirComValorZeroDeveRetornarStatus428()
    {
        $this->post(self::TRANSACTION_URL, [
            'payer_id' => 1,
            'payee_id' => 2,
            'value' => 0
        ]);
        $this->seeStatusCode(BusinessException::CODE_DEFAULT);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
        $this->assertEquals(
            'error',
            $this->response->getData()->status
        );
        $this->assertEquals(
            'Valor inválido.',
            $this->response->getData()->message
        );
    }

    public function testTransferirComPayerEPayeeIguaisDeveRetornarStatus428()
    {
        $this->post(self::TRANSACTION_URL, [
            'payer_id' => 1,
            'payee_id' => 1,
            'value' => 100
        ]);
        $this->seeStatusCode(BusinessException::CODE_SELF_TRANSFER_EXCEPTION);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
        $this->assertEquals(
            'error',
            $this->response->getData()->status
        );
        $this->assertEquals(
            BusinessException::MSG_SELF_TRANSFER_EXCEPTION,
            $this->response->getData()->message
        );
    }

    public function testTransferirComPayerLojistaDeveRetornarStatus428()
    {
        $this->post(self::TRANSACTION_URL, [
            'payer_id' => 2,
            'payee_id' => 1,
            'value' => 100
        ]);
        $this->seeStatusCode(BusinessException::CODE_CANT_TRANSFER_EXCEPTION);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
        $this->assertEquals(
            'error',
            $this->response->getData()->status
        );
        $this->assertEquals(
            BusinessException::MSG_CANT_TRANSFER_EXCEPTION,
            $this->response->getData()->message
        );
    }
}