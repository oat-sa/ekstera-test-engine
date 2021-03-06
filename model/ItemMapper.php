<?php
/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2014 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 */

namespace oat\ekstera\model;

use core_kernel_classes_Resource;

/**
 * An ItemMapper aims at mapping Item Resource to Item identifiers. This is
 * useful at test compilation time to generate string identifiers for items
 * that will be used accross the different components of a Test Model
 * implementation.
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 *
 */
interface ItemMapper
{
    /**
     * Map a given Generis Resource representing an Item in the TAO platform
     * into a string identifier.
     * 
     * @param core_kernel_classes_Resource $item
     * @return string
     * @throws \oat\ekstera\model\ItemMappingException If something goes wrong during the mapping process.
     */
    public function map(core_kernel_classes_Resource $item);
}
