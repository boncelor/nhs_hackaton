<?php

namespace App\Filter;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

final class FriendlyReviewFilter extends AbstractFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {

        $parameterName = $queryNameGenerator->generateParameterName($property); // Generate a unique parameter name to avoid collisions with other filters
        $queryBuilder
            ->andWhere(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->like('o.sentiment', $queryBuilder->expr()->literal('joy')),
                    $queryBuilder->expr()->like('o.sentiment', $queryBuilder->expr()->literal('confident')),
                    $queryBuilder->expr()->like('o.sentiment', $queryBuilder->expr()->literal('analytical'))
                )
            )
            ->setParameter($parameterName, $value);

    }

    // This function is only used to hook in documentation generators (supported by Swagger and Hydra)
    public function getDescription(string $resourceClass): array
    {
        $description = [];

        return $description;
    }
}