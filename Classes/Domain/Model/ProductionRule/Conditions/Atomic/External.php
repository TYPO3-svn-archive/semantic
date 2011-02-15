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
 * In RIF-PRD, the External element is also used to serialize an externally defined atomic formula, in addition to serializing externally defined functions.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_External extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_AtomicInterface, Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface {
	
	/* TODO implement External
	 * 
	 * In RIF-PRD, the External element is also used to serialize an externally defined atomic formula, in addition to serializing externally defined functions.
	 * 
	 * When it is an ATOMIC (as opposed to a TERM; that is, in particular, when it appears in a place where an ATOMIC is expected, and not a TERM), the External element contains one content element that contains one Atom element. The Atom element serializes the externally defined atom properly said:
	 * 
	 * The op Const in the Atom element must be a symbol of type rif:iri that must uniquely identify the externally defined predicate to be applied to the args TERMs.
	 * 
	 *     <External>
	 *        <content>
	 *           Atom
	 *        </content>
	 *     </External>
	 */
	
}
?>