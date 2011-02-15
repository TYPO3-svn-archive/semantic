<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * In RIF, the List element is used to serialize a list.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_List extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface {
	
	/**
	 * The order of the sub-elements is significant and MUST be preserved.
	 * This is emphasized by the fixed value "yes" of the mandatory attribute ordered in the items element.
	 * 
	 * @var bool
	 */
	protected $itemsOrdered = true;
	
	/**
	 * The List element contains one items element, that contains zero or more TERMs (without variables) that serialize the elements of the list.
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface>
	 */
	protected $items;
	
	/**
	 * Sets $itemsOrdered
	 *
	 * @param bool $itemsOrdered
	 */
	public function setmethodName($itemsOrdered) {
		$this->itemsOrdered = $itemsOrdered;
	}
	
	/**
	 * Returns $itemsOrdered
	 *
	 * @return bool
	 */
	public function getmethodName() {
		return $this->itemsOrdered;
	}
	
	/**
	 * Sets items
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface> $items
	 */
	public function setItems(Tx_Extbase_Persistence_ObjectStorage $items) {
		$this->items = $items;
	}
	
	/**
	 * Adds a item
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface item
	 */
	public function addItem(Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $item) {
		$this->items->attach($item);
	}
	
	/**
	 * Removes a item
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $item
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $item) {
		$this->items->detach($item);
	}
	
	/**
	 * Returns items
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing items
	 */
	public function getItems() {
		return $this->items;
	}
	
}
?>