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

namespace oat\ekstera\model\remote;

use core_kernel_classes_Resource;
use taoItems_models_classes_ItemsService;
use oat\ekstera\model\ItemMapper;
use oat\ekstera\model\ItemMappingException;
use qtism\data\storage\xml\XmlDocument;
use qtism\data\storage\xml\XmlStorageException;

/**
 * The RemoteItemMapper class is an implementation of ItemMapper consisting
 * in mapping QTI items by using the qti:assessmentItem->identifier attribute.
 * 
 * This mapper demonstrates to what extent semantics about items is important. Without
 * a common identifier attribute, multiple systems cannot agree on shared identifiers.
 * 
 * In conjunction with Korekton (an external Routing System) and/or GloomRAT (an external Scoring System) 
 * which also understand QTI semantics, an agreement on shared identifiers is successfuly done with Ekstera.
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 * 
 * @see http://www.imsglobal.org/question/qtiv2p1/imsqti_infov2p1.html#element10012 IMS QTI 2.1 assessmentItem component.
 */
class RemoteItemMapper implements ItemMapper {
    
    /**
     * Ingest a given $item and return its qti:assessmentItem->identifier attribute.
     * 
     * @param core_kernel_classes_Resource $item An Item Resource to mapped into an identifier.
     * @return string A QTI Identifier.
     * @throws \oat\ekstera\model\ItemMappingException If the QTI item cannot be parsed correctly.
     */
    public function map(core_kernel_classes_Resource $item) 
    {
        $itemsService = taoItems_models_classes_ItemsService::singleton();
        $qtiDoc = new XmlDocument('2.1');
        
        try {
            $qtiDoc->loadFromString($itemsService->getItemContent($item));
            return $qtiDoc->getDocumentComponent()->getIdentifier();
            
        } catch (XmlStorageException $e) {
            $itemUri = $item->getUri();
            $msg = "An error occured while loading parsing QTI content of item '${itemUri}': " . $e->getMessage();
            throw new ItemMappingException($msg, 0, $e);
        }
    }
}
