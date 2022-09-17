<?php

namespace Phtfao\Panako\Broker\Factory;

use Phtfao\Panako\Broker\Model\User;
use Psr\Container\ContainerInterface;
use Phtfao\Panako\Core\User\UserService;
use Phtfao\Panako\Support\Repository\UserRepository;

class UserServiceFactory
{
    public function __invoke(ContainerInterface $container) : UserService
    {
        $repository = new UserRepository(new User());
        assert($repository instanceof UserRepository);

        return new UserService($repository);
    }
}