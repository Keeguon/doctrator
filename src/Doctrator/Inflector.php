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

namespace Doctrator;

/**
 * Inflector.
 *
 * @package Doctrator
 * @author  Pablo Díez Pascual <pablodip@gmail.com>
 */
class Inflector
{
    /**
     * Camelize a string.
     *
     * Code from Symfony2: http://github.com/symfony/symfony
     *
     * @param string $string The string.
     *
     * @return The string camelized.
     */
    static public function camelize($string)
    {
        return strtr(ucwords(strtr($string, array('_' => ' ', '.' => '_ ', '\\' => '_ '))), array(' ' => ''));
    }

    /**
     * Underscore a string.
     *
     * Code from Symfony2: http://github.com/symfony/symfony
     *
     * @param string $string The string.
     *
     * @return The string underscored.
     */
    static public function underscore($string)
    {
        return strtolower(preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), strtr($string, '_', '.')));
    }
}
