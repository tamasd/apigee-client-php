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

namespace Apigee\Edge\Tests\Api\Management\Controller;

use Apigee\Edge\Tests\Test\Controller\EntityCrudOperationsControllerValidator;
use Apigee\Edge\Tests\Test\Controller\NonPaginatedEntityListingControllerValidatorTrait;
use Apigee\Edge\Tests\Test\Controller\PaginatedEntityIdListingControllerValidatorTrait;

/**
 * Common base test class for \Apigee\Edge\Api\Management\Controller\AppByOwnerControllerInterface implementations.
 */
abstract class AppByOwnerControllerBase extends EntityCrudOperationsControllerValidator
{
    use ApiProductAwareControllerTrait;
    use NonPaginatedEntityListingControllerValidatorTrait;
    use PaginatedEntityIdListingControllerValidatorTrait;

    /**
     * @inheritdoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::setUpApiProduct();
    }

    /**
     * @inheritdoc
     */
    public static function tearDownAfterClass(): void
    {
        static::tearDownApiProduct();
        parent::tearDownAfterClass();
    }
}
