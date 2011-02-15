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
 * As a TERM, the External element is used to serialize a positional term.
 * In RIF-PRD, a positional term represents always a call to an externally defined function,
 * e.g. a built-in, a user-defined function, a query to an external data source, etc.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_External extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface {
	
	/* TODO implement External
	 * 
	 * The External element contains one content element, which in turn contains one Expr element that contains one op element, followed zero or one args element:
	 * 
	 * The External and the content elements ensure compatibility with the RIF Basic Logic Dialect [RIF-BLD] that allows non-evaluated (that is, logic) functions to be serialized using an Expr element alone;
	 * The content of the op element must be a Const. When the External is a TERM, the content of the op element serializes a constant symbol of type rif:iri that must uniquely identify the externallu defined function to be applied to the args TERMs;
	 * The optional args element contains one or more constructs from the TERM abstract class. The args element is used to serialize the arguments of a positional term. The order of the args sub-elements is, therefore, significant and MUST be preserved. This is emphasized by the required value "yes" of the attribute ordered.
	 *     <External>
	 *        <content>
	 *           <Expr>
	 *              <op> Const </op>
	 *              <args ordered="yes"> TERM+ </args>?
	 *           </Expr>
	 *        </content>
	 *     </External>
	 */
	
}
?>