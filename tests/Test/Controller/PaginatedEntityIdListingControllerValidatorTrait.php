<?php

/*
 * Copyright 2018 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Apigee\Edge\Tests\Test\Controller;

use Apigee\Edge\Tests\Test\TestClientFactory;

/**
 * Trait PaginatedEntityIdListingControllerValidatorTrait.
 *
 * @see \Apigee\Edge\Controller\PaginatedEntityIdListingControllerInterface
 */
trait PaginatedEntityIdListingControllerValidatorTrait
{
    /**
     * @dataProvider paginatedTestEntityIdProvider
     *
     * @param string $idField
     */
    public function testPaginatedEntityIdListing(string $idField): void
    {
        /** @var \Apigee\Edge\Controller\PaginatedEntityIdListingControllerInterface $controller */
        $controller = $this->getEntityController();
        $sampleEntity = static::sampleDataForEntityCreate();
        $sampleEntityId = call_user_func([$sampleEntity, 'get' . $idField]);
        $dataset = [];
        for ($i = 1; $i <= 5; ++$i) {
            $dataset[$i] = clone $sampleEntity;
            $dataset[$i]->{'set' . $idField}($i . $sampleEntityId);
        }
        // Create test data on the server or do not do anything if an offline client is in use.
        if (!TestClientFactory::isMockClient(static::$client)) {
            foreach ($dataset as $item) {
                /* @var \Apigee\Edge\Controller\EntityCrudOperationsControllerInterface $controller */
                $controller->create($item);
                static::$createdEntities[$item->id()] = $item;
            }
        }
        // Load a subset of entities.
        $startKey = "3{$sampleEntityId}";
        $limit = 2;
        $pager = $controller->createPager($limit, $startKey);
        $result = $controller->getEntityIds($pager);
        $this->assertEquals($startKey, $result[0]);
        $this->assertCount($limit, $result);
    }

    /**
     * Data provider that returns the id field of the related entity type.
     *
     * @throws \ReflectionException
     *
     * @return array
     */
    abstract public function paginatedTestEntityIdProvider(): array;
}
