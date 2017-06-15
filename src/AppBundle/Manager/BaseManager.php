<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;

abstract class BaseManager
{

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    function __construct(EntityManagerInterface $em, string $repository)
    {
        $this->entityManager = $em;
        $this->repository = $this->entityManager->getRepository($repository);
    }

    /**
     * @param EntityManagerInterface $em
     */
    function setEntityManager(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
        return $this;
    }

    /**
     * @param string $repository
     */
    function setRepository(string $repository)
    {
        $this->repository = $this->entityManager->getRepository($repository);
        return $this;
    }

    function findAll(): array
    {
        return $this->repository->findAll();
    }
}