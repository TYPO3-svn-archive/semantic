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
 * The ACTION_BLOCK class of constructs is used to represent the conclusion, or action part, of a production rule serialized using RIF-PRD.
 * 
 * If action variables are declared in the action part of a rule, or if some actions are not assertions, the conclusion must be serialized as a full action block, using the Do element. However, simple action blocks that contain only one or more assert actions SHOULD be serialized like the conclusions of logic rules using RIF-Core or RIF-BLD, that is, as a single asserted Atom or Frame, or as a conjunction of the asserted facts, using the And element.
 * 
 * In the latter case, to conform with the definition of an action block well-formedness, the formulas that serialize the individual conjuncts MUST be atomic Atoms and/or Frames.
 * 
 * As an abstract class, ACTION_BLOCK is not associated with specific XML markup in RIF-PRD instance documents.
 * 
 *     [ Do | And | Atom | Frame]
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
interface Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionBlockInterface {
	
}
?>