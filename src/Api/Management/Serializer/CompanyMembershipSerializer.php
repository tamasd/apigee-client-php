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

namespace Apigee\Edge\Api\Management\Serializer;

use Apigee\Edge\Api\Management\Denormalizer\CompanyMembershipDenormalizer;
use Apigee\Edge\Api\Management\Normalizer\CompanyMembershipNormalizer;
use Apigee\Edge\Serializer\EntitySerializer;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class CompanyMembershipSerializer extends EntitySerializer
{
    /**
     * CompanyMembershipSerializer constructor.
     *
     * @param array $normalizers
     * @param array $encoders
     * @param null|\Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface $classMetadataFactory
     * @param null|\Symfony\Component\Serializer\NameConverter\NameConverterInterface $nameConverter
     * @param null|\Symfony\Component\PropertyAccess\PropertyAccessorInterface $propertyAccessor
     * @param null|\Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface $propertyTypeExtractor
     */
    public function __construct($normalizers = [], $encoders = [], ?ClassMetadataFactoryInterface $classMetadataFactory = null, ?NameConverterInterface $nameConverter = null, ?PropertyAccessorInterface $propertyAccessor = null, ?PropertyTypeExtractorInterface $propertyTypeExtractor = null)
    {
        $normalizers = array_merge($normalizers, [new CompanyMembershipDenormalizer(), new CompanyMembershipNormalizer()]);
        $encoders = array_merge($encoders, [new JsonEncode()]);
        parent::__construct($normalizers, $encoders, $classMetadataFactory, $nameConverter, $propertyAccessor, $propertyTypeExtractor);
    }
}
