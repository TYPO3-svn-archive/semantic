<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic\Sparql\Parser\Sparql10;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
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
 * @category Erfurt
 * @package Sparql_Parser_Sparql10
 * @author Rolland Brunec <rollxx@gmail.com>
 * @copyright Copyright (c) 2010 {@link http://aksw.org aksw}
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License (GPL)
 */
# for convenience in actions
if (!defined('HIDDEN')) define('HIDDEN', \BaseRecognizer::$HIDDEN);
class Sparql10Parser extends \AntlrParser {

	public static $tokenNames = array(
		"<invalid>", "<EOR>", "<DOWN>", "<UP>", "BASE", "PREFIX", "NOT", "SELECT", "DISTINCT", "REDUCED", "CONSTRUCT", "DESCRIBE", "ASK", "FROM", "NAMED", "WHERE", "ORDER", "GROUP", "BY", "ASC", "DESC", "LIMIT", "OFFSET", "OPTIONAL", "GRAPH", "UNION", "FILTER", "A", "AS", "STR", "LANG", "LANGMATCHES", "DATATYPE", "BOUND", "SAMETERM", "ISIRI", "ISURI", "ISBLANK", "ISLITERAL", "REGEX", "TRUE", "FALSE", "LESS", "GREATER", "OPEN_CURLY_BRACE", "CLOSE_CURLY_BRACE", "IRI_REF", "PN_PREFIX", "PNAME_NS", "PN_LOCAL", "PNAME_LN", "VARNAME", "VAR1", "VAR2", "MINUS", "LANGTAG", "INTEGER", "DOT", "DECIMAL", "DIGIT", "EXPONENT", "DOUBLE", "PLUS", "INTEGER_POSITIVE", "DECIMAL_POSITIVE", "DOUBLE_POSITIVE", "INTEGER_NEGATIVE", "DECIMAL_NEGATIVE", "DOUBLE_NEGATIVE", "ECHAR", "UNICODE_CHAR", "STRING_LITERAL1", "STRING_LITERAL2", "STRING_LITERAL_LONG1", "STRING_LITERAL_LONG2", "HEX_DIGIT", "EOL", "WS", "PN_CHARS_BASE", "PN_CHARS_U", "PN_CHARS", "BLANK_NODE_LABEL", "REFERENCE", "AND", "OR", "OR_SINGLE", "COMMENT", "SEMICOLON", "ASTERISK", "COMMA", "NOT_SIGN", "DIVIDE", "EQUAL", "OPEN_BRACE", "CLOSE_BRACE", "LESS_EQUAL", "GREATER_EQUAL", "NOT_EQUAL", "OPEN_SQUARE_BRACE", "CLOSE_SQUARE_BRACE", "HAT_LABEL"
	);
	public $PREFIX = 5;
	public $EXPONENT = 60;
	public $CLOSE_SQUARE_BRACE = 99;
	public $GRAPH = 24;
	public $REGEX = 39;
	public $PNAME_LN = 50;
	public $CONSTRUCT = 10;
	public $NOT = 6;
	public $EOF = -1;
	public $VARNAME = 51;
	public $ISLITERAL = 38;
	public $GREATER = 43;
	public $EOL = 76;
	public $NOT_EQUAL = 97;
	public $LESS = 42;
	public $LANGMATCHES = 31;
	public $DOUBLE = 61;
	public $BASE = 4;
	public $PN_CHARS_U = 79;
	public $COMMENT = 86;
	public $SELECT = 7;
	public $OPEN_CURLY_BRACE = 44;
	public $CLOSE_CURLY_BRACE = 45;
	public $DOUBLE_POSITIVE = 65;
	public $BOUND = 33;
	public $DIVIDE = 91;
	public $ISIRI = 35;
	public $A = 27;
	public $NOT_SIGN = 90;
	public $ASC = 19;
	public $ASK = 12;
	public $BLANK_NODE_LABEL = 81;
	public $SEMICOLON = 87;
	public $ISBLANK = 37;
	public $GROUP = 17;
	public $WS = 77;
	public $OR_SINGLE = 85;
	public $NAMED = 14;
	public $INTEGER_POSITIVE = 63;
	public $STRING_LITERAL2 = 72;
	public $OR = 84;
	public $FILTER = 26;
	public $DESCRIBE = 11;
	public $STRING_LITERAL1 = 71;
	public $PN_CHARS = 80;
	public $DATATYPE = 32;
	public $LESS_EQUAL = 95;
	public $DOUBLE_NEGATIVE = 68;
	public $FROM = 13;
	public $FALSE = 41;
	public $DISTINCT = 8;
	public $LANG = 30;
	public $WHERE = 15;
	public $IRI_REF = 46;
	public $ORDER = 16;
	public $LIMIT = 21;
	public $AND = 83;
	public $ASTERISK = 88;
	public $ISURI = 36;
	public $STR = 29;
	public $AS = 28;
	public $SAMETERM = 34;
	public $COMMA = 89;
	public $OFFSET = 22;
	public $EQUAL = 92;
	public $DECIMAL_POSITIVE = 64;
	public $PLUS = 62;
	public $DIGIT = 59;
	public $DOT = 57;
	public $INTEGER = 56;
	public $BY = 18;
	public $REDUCED = 9;
	public $INTEGER_NEGATIVE = 66;
	public $PN_LOCAL = 49;
	public $PNAME_NS = 48;
	public $HEX_DIGIT = 75;
	public $REFERENCE = 82;
	public $CLOSE_BRACE = 94;
	public $MINUS = 54;
	public $TRUE = 40;
	public $OPEN_SQUARE_BRACE = 98;
	public $UNION = 25;
	public $ECHAR = 69;
	public $OPTIONAL = 23;
	public $HAT_LABEL = 100;
	public $STRING_LITERAL_LONG2 = 74;
	public $PN_CHARS_BASE = 78;
	public $DECIMAL = 58;
	public $VAR1 = 52;
	public $VAR2 = 53;
	public $STRING_LITERAL_LONG1 = 73;
	public $DECIMAL_NEGATIVE = 67;
	public $PN_PREFIX = 47;
	public $UNICODE_CHAR = 70;
	public $DESC = 20;
	public $OPEN_BRACE = 93;
	public $GREATER_EQUAL = 96;
	public $LANGTAG = 55;

	// delegates
	public $gSparql10;
	// delegators


	static $FOLLOW_query10_in_parse71;
	static $FOLLOW_EOF_in_parse73;


	public function __construct($input, $state = null) {
		if ($state == null) {
			$state = new \RecognizerSharedState();
		}
		parent::__construct($input, $state);
		$this->gSparql10 = new Sparql10\Sparql10($input, $state, $this);


	}


	public function getTokenNames() {
		return self::$tokenNames;
	}

	public function getGrammarFileName() {
		return "src/Erfurt_Sparql_Parser_Sparql10_Sparql10.g";
	}


	private $_errors = array();

	public function emitErrorMessage($msg) {
		$this->_errors [] = $msg;
	}

	public function getErrors() {
		return $this->_errors;
	}


	// $ANTLR start "parse"
	// src/Erfurt_Sparql_Parser_Sparql10_Sparql10.g:54:1: parse returns [$value] : query10 EOF ;
	public function parse() {
		$value = null;

		$query101 = null;


		try {
			// src/Erfurt_Sparql_Parser_Sparql10_Sparql10.g:55:3: ( query10 EOF )
			// src/Erfurt_Sparql_Parser_Sparql10_Sparql10.g:56:3: query10 EOF
			{
				$this->pushFollow(self::$FOLLOW_query10_in_parse71);
				$query101 = $this->query10();

				$this->state->_fsp--;

				$this->match($this->input, $this->getToken('EOF'), self::$FOLLOW_EOF_in_parse73);
				$value = ($query101 != null ? $query101->value : null);

			}

		}
		catch (\RecognitionException $re) {
			$this->reportError($re);
			$this->recover($this->input, $re);
		}
		catch (\Exception $e) {
			throw $e;
		}

		return $value;
	}

	// $ANTLR end "parse"

	// Delegated rules
	public function numericLiteral() {
		return $this->gSparql10->numericLiteral();
	}

	public function valueLogical() {
		return $this->gSparql10->valueLogical();
	}

	public function numericLiteralPositive() {
		return $this->gSparql10->numericLiteralPositive();
	}

	public function unaryExpression() {
		return $this->gSparql10->unaryExpression();
	}

	public function baseDecl() {
		$this->gSparql10->baseDecl();
	}

	public function conditionalAndExpression() {
		return $this->gSparql10->conditionalAndExpression();
	}

	public function string() {
		return $this->gSparql10->string();
	}

	public function booleanLiteral() {
		return $this->gSparql10->booleanLiteral();
	}

	public function query10() {
		return $this->gSparql10->query10();
	}

	public function varOrIRIref() {
		return $this->gSparql10->varOrIRIref();
	}

	public function whereClause() {
		$this->gSparql10->whereClause();
	}

	public function prefixDecl() {
		$this->gSparql10->prefixDecl();
	}

	public function optionalGraphPattern() {
		return $this->gSparql10->optionalGraphPattern();
	}

	public function graphPatternNotTriples() {
		return $this->gSparql10->graphPatternNotTriples();
	}

	public function triplesBlock() {
		return $this->gSparql10->triplesBlock();
	}

	public function solutionModifier() {
		$this->gSparql10->solutionModifier();
	}

	public function filter() {
		return $this->gSparql10->filter();
	}

	public function propertyListNotEmpty() {
		return $this->gSparql10->propertyListNotEmpty();
	}

	public function constructQuery() {
		$this->gSparql10->constructQuery();
	}

	public function offsetClause() {
		$this->gSparql10->offsetClause();
	}

	public function namedGraphClause() {
		return $this->gSparql10->namedGraphClause();
	}

	public function limitOffsetClauses() {
		$this->gSparql10->limitOffsetClauses();
	}

	public function constraint() {
		return $this->gSparql10->constraint();
	}

	public function propertyList() {
		return $this->gSparql10->propertyList();
	}

	public function primaryExpression() {
		return $this->gSparql10->primaryExpression();
	}

	public function numericLiteralUnsigned() {
		return $this->gSparql10->numericLiteralUnsigned();
	}

	public function multiplicativeExpression() {
		return $this->gSparql10->multiplicativeExpression();
	}

	public function conditionalOrExpression() {
		return $this->gSparql10->conditionalOrExpression();
	}

	public function graphTerm() {
		return $this->gSparql10->graphTerm();
	}

	public function askQuery() {
		$this->gSparql10->askQuery();
	}

	public function triplesNode() {
		return $this->gSparql10->triplesNode();
	}

	public function numericExpression() {
		return $this->gSparql10->numericExpression();
	}

	public function brackettedExpression() {
		return $this->gSparql10->brackettedExpression();
	}

	public function relationalExpression() {
		return $this->gSparql10->relationalExpression();
	}

	public function graphGraphPattern() {
		return $this->gSparql10->graphGraphPattern();
	}

	public function prefixedName() {
		return $this->gSparql10->prefixedName();
	}

	public function orderClause() {
		$this->gSparql10->orderClause();
	}

	public function sourceSelector() {
		return $this->gSparql10->sourceSelector();
	}

	public function builtInCall() {
		return $this->gSparql10->builtInCall();
	}

	public function describeQuery() {
		$this->gSparql10->describeQuery();
	}

	public function orderCondition() {
		$this->gSparql10->orderCondition();
	}

	public function regexExpression() {
		return $this->gSparql10->regexExpression();
	}

	public function prologue() {
		$this->gSparql10->prologue();
	}

	public function constructTemplate() {
		return $this->gSparql10->constructTemplate();
	}

	public function groupGraphPattern() {
		return $this->gSparql10->groupGraphPattern();
	}

	public function varOrTerm() {
		return $this->gSparql10->varOrTerm();
	}

	public function expression() {
		return $this->gSparql10->expression();
	}

	public function argList() {
		return $this->gSparql10->argList();
	}

	public function iriRef() {
		return $this->gSparql10->iriRef();
	}

	public function groupOrUnionGraphPattern() {
		return $this->gSparql10->groupOrUnionGraphPattern();
	}

	public function object() {
		return $this->gSparql10->object();
	}

	public function constructTriples() {
		return $this->gSparql10->constructTriples();
	}

	public function triplesSameSubject() {
		return $this->gSparql10->triplesSameSubject();
	}

	public function selectQuery() {
		$this->gSparql10->selectQuery();
	}

	public function collection() {
		return $this->gSparql10->collection();
	}

	public function blankNodePropertyList() {
		return $this->gSparql10->blankNodePropertyList();
	}

	public function objectList() {
		return $this->gSparql10->objectList();
	}

	public function functionCall() {
		return $this->gSparql10->functionCall();
	}

	public function variable() {
		return $this->gSparql10->variable();
	}

	public function datasetClause() {
		$this->gSparql10->datasetClause();
	}

	public function graphNode() {
		return $this->gSparql10->graphNode();
	}

	public function verb() {
		return $this->gSparql10->verb();
	}

	public function blankNode() {
		return $this->gSparql10->blankNode();
	}

	public function rdfLiteral() {
		return $this->gSparql10->rdfLiteral();
	}

	public function iriRefOrFunction() {
		return $this->gSparql10->iriRefOrFunction();
	}

	public function numericLiteralNegative() {
		return $this->gSparql10->numericLiteralNegative();
	}

	public function limitClause() {
		$this->gSparql10->limitClause();
	}

	public function additiveExpression() {
		return $this->gSparql10->additiveExpression();
	}

	public function defaultGraphClause() {
		return $this->gSparql10->defaultGraphClause();
	}


}


Sparql10Parser::$FOLLOW_query10_in_parse71 = new \Set(array());
Sparql10Parser::$FOLLOW_EOF_in_parse73 = new \Set(array(1));

?>