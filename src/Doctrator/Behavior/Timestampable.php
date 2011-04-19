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

namespace Doctrator\Behavior;

use Mandango\Mondator\ClassExtension;
use Mandango\Mondator\Definition\Method;

/**
 * The doctrator Timestampable behavior.
 *
 * @package Doctrator
 * @author  Pablo Díez Pascual <pablodip@gmail.com>
 */
class Timestampable extends ClassExtension
{
    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->addOptions(array(
            'created_enabled' => true,
            'created_column'  => 'createdAt',
            'updated_enabled' => true,
            'updated_column'  => 'updatedAt',
        ));
    }

    /**
     * @inheritdoc
     */
    protected function doConfigClassProcess()
    {
        // created
        if ($this->getOption('created_enabled')) {
            $column = $this->getOption('created_column');
            $this->configClass['columns'][$column] = array('type' => 'datetime', 'nullable' => true);

            $this->configClass['events']['prePersist'][] = 'updateTimestampableCreated';
        }

        // updated
        if ($this->getOption('updated_enabled')) {
            $column = $this->getOption('updated_column');
            $this->configClass['columns'][$column] = array('type' => 'datetime', 'nullable' => true);

            $this->configClass['events']['preUpdate'][] = 'updateTimestampableUpdated';
        }
    }

    /**
     * @inheritdoc
     */
    protected function doClassProcess()
    {
        /*
         * Created.
         */
        if ($this->getOption('created_enabled')) {
            // column
            $column = $this->getOption('created_column');

            // event
            $method = new Method('public', 'updateTimestampableCreated', '', <<<EOF
        \$this->set('$column', new \DateTime());
EOF
            );

            $this->definitions['entity_base']->addMethod($method);
        }

        /*
         * Updated.
         */
        if ($this->getOption('updated_enabled')) {
            // column
            $column = $this->getOption('updated_column');

            // event

            $method = new Method('public', 'updateTimestampableUpdated', '', <<<EOF
        \$this->set('$column', new \DateTime());
EOF
            );

            $this->definitions['entity_base']->addMethod($method);
        }
    }
}
