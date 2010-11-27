<?php

/*
 * Copyright 2010 Pablo Díez Pascual <pablodip@gmail.com>
 *
 * This file is part of Doctrator.
 *
 * Doctrator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Doctrator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Doctrator. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Doctrator\Tests\Extension;

use Model\Entity\Article;

class EntityDataCamelCaseMapTest extends \Doctrator\Tests\TestCase
{
    public function testGetDataCamelCaseMap()
    {
        $this->assertSame(array(
            'id'        => 'Id',
            'title'     => 'Title',
            'slug'      => 'Slug',
            'content'   => 'Content',
            'source'    => 'Source',
            'is_active' => 'IsActive',
            'score'     => 'Score',
            'date'      => 'Date',
            'category'  => 'Category',
        ), Article::getDataCamelCaseMap());
    }
}
