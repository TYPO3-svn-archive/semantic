# Dump of table tx_semantic_domain_model_rdf_namespace
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tx_semantic_domain_model_rdf_namespace`;

CREATE TABLE `tx_semantic_domain_model_rdf_namespace` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `prefix` varchar(255) NOT NULL DEFAULT '',
  `iri` varchar(255) NOT NULL DEFAULT '',
  `deleted` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `parent` (`pid`)
) AUTO_INCREMENT=32;

LOCK TABLES `tx_semantic_domain_model_rdf_namespace` WRITE;
/*!40000 ALTER TABLE `tx_semantic_domain_model_rdf_namespace` DISABLE KEYS */;
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (1,0,'xml','http://www.w3.org/XML/1998/namespace',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (2,0,'xmlns','http://www.w3.org/2000/xmlns/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (3,0,'xsd','http://www.w3.org/2001/XMLSchema#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (4,0,'xhv','http://www.w3.org/1999/xhtml/vocab#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (5,0,'rdfa','http://www.w3.org/ns/rdfa#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (6,0,'rdf','http://www.w3.org/1999/02/22-rdf-syntax-ns#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (7,0,'rdfs','http://www.w3.org/2000/01/rdf-schema#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (8,0,'owl','http://www.w3.org/2002/07/owl#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (9,0,'rif','http://www.w3.org/2007/rif#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (10,0,'skos','http://www.w3.org/2004/02/skos/core#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (11,0,'skosxl','http://www.w3.org/2008/05/skos-xl#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (12,0,'grddl','http://www.w3.org/2003/g/data-view#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (13,0,'sd','http://www.w3.org/ns/sparql-service-description#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (14,0,'wdr','http://www.w3.org/2007/05/powder#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (15,0,'wdrs','http://www.w3.org/2007/05/powder-s#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (16,0,'sioc','http://rdfs.org/sioc/ns#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (17,0,'cc','http://creativecommons.org/ns#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (18,0,'vcard','http://www.w3.org/2006/vcard/ns#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (19,0,'void','http://rdfs.org/ns/void#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (20,0,'dc','http://purl.org/dc/elements/1.1/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (21,0,'dcterms','http://purl.org/dc/terms/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (22,0,'dbr','http://dbpedia.org/resource/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (23,0,'dbp','http://dbpedia.org/property/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (24,0,'dbp-owl','http://dbpedia.org/ontology/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (25,0,'foaf','http://xmlns.com/foaf/0.1/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (26,0,'geo','http://www.w3.org/2003/01/geo/wgs84_pos#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (27,0,'gr','http://purl.org/goodrelations/v1#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (28,0,'cal','http://www.w3.org/2002/12/cal/ical#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (29,0,'og','http://ogp.me/ns#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (30,0,'v','http://rdf.data-vocabulary.org/#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (31,0,'bibo','http://purl.org/ontology/bibo/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (32,0,'xmlns','http://www.w3.org/2000/xmlns/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (33,0,'sysont','http://ns.typo3.org/SysOnt/4.6/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (34,0,'sysconf','http://localhost/TYPO3/Config/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (35,0,'bio','http://purl.org/vocab/bio/0.1/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (36,0,'cc','http://web.resource.org/cc/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (37,0,'doap','http://usefulinc.com/ns/doap#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (38,0,'geonames','http://www.geonames.org/ontology#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (39,0,'review','http://purl.org/stuff/rev#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (40,0,'sioct','http://rdfs.org/sioc/types#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (41,0,'status','http://www.w3.org/2003/06/sw-vocab-status/ns#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (42,0,'swivt','http://semantic-mediawiki.org/swivt/1.0#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (43,0,'tags','http://www.holygoat.co.uk/owl/redwood/0.1/tags/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (44,0,'vann','http://purl.org/vocab/vann/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (45,0,'vcard3','http://www.w3.org/2001/vcard-rdf/3.0#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (46,0,'vs','http://www.w3.org/2003/06/sw-vocab-status/ns#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (47,0,'wot','http://xmlns.com/wot/0.1/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (48,0,'wordnet','http://xmlns.com/wordnet/1.6/',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (49,0,'swrc','http://swrc.ontoware.org/ontology#',0,0);
INSERT INTO `tx_semantic_domain_model_rdf_namespace` VALUES (50,0,'lcl','http://ns.aksw.org/e-learning/lcl/',0,0);

/*!40000 ALTER TABLE `tx_semantic_domain_model_rdf_namespace` ENABLE KEYS */;
UNLOCK TABLES;