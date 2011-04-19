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
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

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


# Dump of table tx_semantic_graph
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tx_semantic_graph`;

CREATE TABLE `tx_semantic_graph` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(160) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `uri_r` int(10) unsigned DEFAULT NULL,
  `base` varchar(160) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `base_r` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_graph` (`uri`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ascii;

LOCK TABLES `tx_semantic_graph` WRITE;
/*!40000 ALTER TABLE `tx_semantic_graph` DISABLE KEYS */;
INSERT INTO `tx_semantic_graph` VALUES (1,'http://localhost/OntoWiki/Config/',NULL,'http://localhost/OntoWiki/Config/',NULL);
INSERT INTO `tx_semantic_graph` VALUES (2,'http://ns.ontowiki.net/SysOnt/',NULL,'http://ns.ontowiki.net/SysOnt/',NULL);

/*!40000 ALTER TABLE `tx_semantic_graph` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tx_semantic_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tx_semantic_info`;

CREATE TABLE `tx_semantic_info` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `schema_id` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ascii;

LOCK TABLES `tx_semantic_info` WRITE;
/*!40000 ALTER TABLE `tx_semantic_info` DISABLE KEYS */;
INSERT INTO `tx_semantic_info` VALUES (1,'1.0');

/*!40000 ALTER TABLE `tx_semantic_info` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tx_semantic_literal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tx_semantic_literal`;

CREATE TABLE `tx_semantic_literal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g` int(10) unsigned NOT NULL,
  `v` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `vh` char(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_lit` (`g`,`vh`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ascii;

LOCK TABLES `tx_semantic_literal` WRITE;
/*!40000 ALTER TABLE `tx_semantic_literal` DISABLE KEYS */;
INSERT INTO `tx_semantic_literal` (`id`,`g`,`v`,`vh`) VALUES (1,2,X'54686973207370656369616C206163636F756E742069732074686520537570657241646D696E6973747261746F722E20486520686173206861726420636F6465642061636365737320746F20616C6C206D6F64656C7320616E6420616374696F6E7320616E642075736573207468652075736572206E69636B20616E6420706173732066726F6D2074686520646174616261736520636F6E66696775726174696F6E2E20416C6C2061636365737320636F6E74726F6C2073746174656D656E7473206F6620746869732075736572206172652069676E6F726564206279207468652073797374656D2E',X'6638643862633132313537326633633136343634383932373934666439646363');

/*!40000 ALTER TABLE `tx_semantic_literal` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tx_semantic_statement
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tx_semantic_statement`;

CREATE TABLE `tx_semantic_statement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g` int(10) unsigned NOT NULL,
  `s` varchar(160) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `p` varchar(160) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `o` varchar(160) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `s_r` int(10) unsigned DEFAULT NULL,
  `p_r` int(10) unsigned DEFAULT NULL,
  `o_r` int(10) unsigned DEFAULT NULL,
  `st` tinyint(1) unsigned NOT NULL,
  `ot` tinyint(1) unsigned NOT NULL,
  `ol` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `od` varchar(160) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `od_r` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_stmt` (`g`,`s`,`p`,`o`,`st`,`ot`,`ol`,`od`),
  KEY `idx_g_p_o_ot` (`g`,`p`,`o`,`ot`),
  KEY `idx_g_o_ot` (`g`,`o`,`ot`)
) ENGINE=MyISAM AUTO_INCREMENT=224 DEFAULT CHARSET=ascii;

LOCK TABLES `tx_semantic_statement` WRITE;
/*!40000 ALTER TABLE `tx_semantic_statement` DISABLE KEYS */;
INSERT INTO `tx_semantic_statement` VALUES (1,1,'http://localhost/OntoWiki/Config/','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#Ontology',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (2,1,'http://localhost/OntoWiki/Config/','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (3,1,'http://localhost/OntoWiki/Config/','http://www.w3.org/2000/01/rdf-schema#label','OntoWiki System Configuration',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (4,1,'http://localhost/OntoWiki/Config/','http://www.w3.org/2000/01/rdf-schema#comment','This is your OntoWiki configuration model. You can configure model based access control and some actions here.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (5,1,'http://localhost/OntoWiki/Config/','http://www.w3.org/2002/07/owl#imports','http://ns.ontowiki.net/SysOnt/',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (6,1,'http://localhost/OntoWiki/Config/','http://www.w3.org/2002/07/owl#versionInfo','http://code.google.com/p/ontowiki/source/list?path=/erfurt/src/Erfurt/include/SysOntLocal.rdf',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (7,1,'http://ns.ontowiki.net/SysOnt/','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#Ontology',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (8,1,'http://ns.ontowiki.net/SysOnt/','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (9,1,'http://ns.ontowiki.net/SysOnt/','http://ns.ontowiki.net/SysOnt/hidden','true',NULL,NULL,NULL,0,2,'','http://www.w3.org/2001/XMLSchema#boolean',NULL);
INSERT INTO `tx_semantic_statement` VALUES (10,1,'http://ns.ontowiki.net/SysOnt/','http://ns.ontowiki.net/SysOnt/isLarge','true',NULL,NULL,NULL,0,2,'','http://www.w3.org/2001/XMLSchema#boolean',NULL);
INSERT INTO `tx_semantic_statement` VALUES (11,1,'http://localhost/OntoWiki/Config/Admin','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://rdfs.org/sioc/ns#User',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (12,1,'http://localhost/OntoWiki/Config/Admin','http://www.w3.org/2000/01/rdf-schema#label','Admin',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (13,1,'http://localhost/OntoWiki/Config/Admin','http://www.w3.org/2000/01/rdf-schema#comment','This is the pre-configured Admin User.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (14,1,'http://localhost/OntoWiki/Config/Admin','http://xmlns.com/foaf/0.1/accountName','Admin',NULL,NULL,NULL,0,2,'','http://www.w3.org/2001/XMLSchema#string',NULL);
INSERT INTO `tx_semantic_statement` VALUES (15,1,'http://localhost/OntoWiki/Config/AdminGroup','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://rdfs.org/sioc/ns#Usergroup',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (16,1,'http://localhost/OntoWiki/Config/AdminGroup','http://www.w3.org/2000/01/rdf-schema#label','AdminGroup',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (17,1,'http://localhost/OntoWiki/Config/AdminGroup','http://ns.ontowiki.net/SysOnt/denyModelEdit','http://ns.ontowiki.net/SysOnt/',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (18,1,'http://localhost/OntoWiki/Config/AdminGroup','http://ns.ontowiki.net/SysOnt/grantAccess','http://ns.ontowiki.net/SysOnt/AnyAction',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (19,1,'http://localhost/OntoWiki/Config/AdminGroup','http://ns.ontowiki.net/SysOnt/grantModelEdit','http://ns.ontowiki.net/SysOnt/AnyModel',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (20,1,'http://localhost/OntoWiki/Config/AdminGroup','http://ns.ontowiki.net/SysOnt/grantModelView','http://ns.ontowiki.net/SysOnt/AnyModel',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (21,1,'http://localhost/OntoWiki/Config/AdminGroup','http://www.w3.org/2000/01/rdf-schema#comment','The group of all admins. If not changed, they can trigger all actions and can edit all models but the system ontology.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (22,1,'http://localhost/OntoWiki/Config/AdminGroup','http://rdfs.org/sioc/ns#has_member','http://localhost/OntoWiki/Config/Admin',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (23,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://rdfs.org/sioc/ns#Usergroup',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (24,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://www.w3.org/2000/01/rdf-schema#label','DefaultUserGroup',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (25,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://ns.ontowiki.net/SysOnt/grantAccess','http://ns.ontowiki.net/SysOnt/RegisterNewUser',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (26,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://ns.ontowiki.net/SysOnt/grantAccess','http://ns.ontowiki.net/SysOnt/Login',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (27,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://ns.ontowiki.net/SysOnt/grantAccess','http://ns.ontowiki.net/SysOnt/Rollback',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (28,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://ns.ontowiki.net/SysOnt/denyModelView','http://localhost/OntoWiki/Config/',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (29,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://ns.ontowiki.net/SysOnt/denyModelView','http://ns.ontowiki.net/SysOnt/',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (30,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://ns.ontowiki.net/SysOnt/denyModelEdit','http://ns.ontowiki.net/SysBase/',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (31,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://ns.ontowiki.net/SysOnt/grantModelEdit','http://ns.ontowiki.net/SysOnt/AnyModel',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (32,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://ns.ontowiki.net/SysOnt/grantModelView','http://ns.ontowiki.net/SysOnt/AnyModel',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (33,1,'http://localhost/OntoWiki/Config/DefaultUserGroup','http://www.w3.org/2000/01/rdf-schema#comment','This pre-configured user group can login, register new user and edit all models except the system models.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (34,1,'http://ns.ontowiki.net/SysOnt/Anonymous','http://ns.ontowiki.net/SysOnt/grantAccess','http://ns.ontowiki.net/SysOnt/RegisterNewUser',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (35,1,'http://ns.ontowiki.net/SysOnt/Anonymous','http://ns.ontowiki.net/SysOnt/denyAccess','http://ns.ontowiki.net/SysOnt/Login',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (36,1,'http://ns.ontowiki.net/SysOnt/Anonymous','http://ns.ontowiki.net/SysOnt/denyAccess','http://ns.ontowiki.net/SysOnt/Rollback',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (37,1,'http://ns.ontowiki.net/SysOnt/Anonymous','http://ns.ontowiki.net/SysOnt/denyModelView','http://localhost/OntoWiki/Config/',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (38,1,'http://ns.ontowiki.net/SysOnt/Anonymous','http://ns.ontowiki.net/SysOnt/denyModelView','http://ns.ontowiki.net/SysOnt/',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (39,1,'http://ns.ontowiki.net/SysOnt/Anonymous','http://ns.ontowiki.net/SysOnt/grantModelView','http://ns.ontowiki.net/SysBase/',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (40,1,'http://ns.ontowiki.net/SysOnt/Anonymous','http://ns.ontowiki.net/SysOnt/grantModelView','http://ns.ontowiki.net/SysOnt/AnyModel',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (41,1,'http://ns.ontowiki.net/SysOnt/Anonymous','http://ns.ontowiki.net/SysOnt/grantModelEdit','http://ns.ontowiki.net/SysOnt/AnyModel',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (42,1,'http://ns.ontowiki.net/SysOnt/RegisterNewUser','http://ns.ontowiki.net/SysOnt/rawConfig','defaultGroup=http://localhost/OntoWiki/Config/DefaultUserGroup',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (43,1,'http://ns.ontowiki.net/SysOnt/RegisterNewUser','http://ns.ontowiki.net/SysOnt/rawConfig','mailvalidation=yes',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (44,1,'http://ns.ontowiki.net/SysOnt/RegisterNewUser','http://ns.ontowiki.net/SysOnt/rawConfig','uidregexp=\"/^[[:alnum:]]+$/\"',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (45,1,'http://ns.ontowiki.net/SysOnt/RegisterNewUser','http://ns.ontowiki.net/SysOnt/rawConfig','passregexp=\"\"',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (46,1,'http://ns.ontowiki.net/SysOnt/Login','http://ns.ontowiki.net/SysOnt/rawConfig','type=RDF',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (47,1,'http://ns.ontowiki.net/SysOnt/Rollback','http://ns.ontowiki.net/SysOnt/rawConfig','global=on',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (64,1,'http://localhost/OntoWiki/Config/','http://ns.ontowiki.net/SysOnt/prefix','foaf=http://xmlns.com/foaf/0.1/',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (67,1,'http://localhost/OntoWiki/Config/','http://ns.ontowiki.net/SysOnt/prefix','rdf=http://www.w3.org/1999/02/22-rdf-syntax-ns#',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (66,1,'http://localhost/OntoWiki/Config/','http://ns.ontowiki.net/SysOnt/prefix','owl=http://www.w3.org/2002/07/owl#',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (65,1,'http://localhost/OntoWiki/Config/','http://ns.ontowiki.net/SysOnt/prefix','sioc=http://rdfs.org/sioc/ns#',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (63,1,'http://localhost/OntoWiki/Config/','http://ns.ontowiki.net/SysOnt/prefix','sysont=http://ns.ontowiki.net/SysOnt/',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (68,1,'http://localhost/OntoWiki/Config/','http://ns.ontowiki.net/SysOnt/prefix','rdfs=http://www.w3.org/2000/01/rdf-schema#',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (69,2,'http://ns.ontowiki.net/SysOnt/','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#Ontology',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (70,2,'http://ns.ontowiki.net/SysOnt/','http://www.w3.org/2000/01/rdf-schema#label','OntoWiki System Ontology',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (71,2,'http://ns.ontowiki.net/SysOnt/','http://www.w3.org/2000/01/rdf-schema#comment','This schema model provides the vocabulary to configure an OntoWiki installation (e.g. terms for access control). Some terms are copied from FOAF.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (72,2,'http://ns.ontowiki.net/SysOnt/','http://www.w3.org/2002/07/owl#versionInfo','http://code.google.com/p/ontowiki/source/list?path=/erfurt/src/Erfurt/include/SysOnt.rdf',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (73,2,'http://ns.ontowiki.net/SysOnt/Action','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#Class',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (74,2,'http://ns.ontowiki.net/SysOnt/Action','http://www.w3.org/2000/01/rdf-schema#label','Action',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (75,2,'http://ns.ontowiki.net/SysOnt/Action','http://www.w3.org/2000/01/rdf-schema#comment','Actions represent specific GUI or API actions which can be activated or used by an Agent.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (76,2,'http://ns.ontowiki.net/SysOnt/Model','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#Class',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (77,2,'http://ns.ontowiki.net/SysOnt/Model','http://www.w3.org/2000/01/rdf-schema#label','Model',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (78,2,'http://ns.ontowiki.net/SysOnt/Model','http://www.w3.org/2000/01/rdf-schema#comment','A model is a knowledge base in OntoWiki.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (79,2,'http://rdfs.org/sioc/ns#User','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#Class',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (80,2,'http://rdfs.org/sioc/ns#User','http://www.w3.org/2000/01/rdf-schema#comment','Users are able to log into OntoWiki.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (81,2,'http://rdfs.org/sioc/ns#User','http://www.w3.org/2000/01/rdf-schema#label','User',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (82,2,'http://rdfs.org/sioc/ns#Usergroup','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#Class',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (83,2,'http://rdfs.org/sioc/ns#Usergroup','http://www.w3.org/2000/01/rdf-schema#comment','A Group of User Accounts ...',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (84,2,'http://rdfs.org/sioc/ns#Usergroup','http://www.w3.org/2000/01/rdf-schema#label','Usergroup',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (85,2,'b1','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#Class',NULL,NULL,NULL,1,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (86,2,'b1','http://www.w3.org/2002/07/owl#unionOf','node1',NULL,NULL,NULL,1,1,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (87,2,'node1','http://www.w3.org/1999/02/22-rdf-syntax-ns#first','http://rdfs.org/sioc/ns#User',NULL,NULL,NULL,1,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (88,2,'node1','http://www.w3.org/1999/02/22-rdf-syntax-ns#rest','node2',NULL,NULL,NULL,1,1,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (89,2,'node2','http://www.w3.org/1999/02/22-rdf-syntax-ns#first','http://rdfs.org/sioc/ns#Usergroup',NULL,NULL,NULL,1,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (90,2,'node2','http://www.w3.org/1999/02/22-rdf-syntax-ns#rest','http://www.w3.org/1999/02/22-rdf-syntax-ns#nil',NULL,NULL,NULL,1,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (91,2,'http://www.w3.org/2001/XMLSchema#string','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2000/01/rdf-schema#Datatype',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (92,2,'http://www.w3.org/2001/XMLSchema#string','http://www.w3.org/2000/01/rdf-schema#label','String',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (93,2,'http://www.w3.org/2001/XMLSchema#anyURI','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2000/01/rdf-schema#Datatype',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (94,2,'http://www.w3.org/2001/XMLSchema#anyURI','http://www.w3.org/2000/01/rdf-schema#label','Any URI',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (95,2,'http://www.w3.org/2001/XMLSchema#boolean','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2000/01/rdf-schema#Datatype',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (96,2,'http://www.w3.org/2001/XMLSchema#boolean','http://www.w3.org/2000/01/rdf-schema#label','Boolean',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (97,2,'http://www.w3.org/2000/01/rdf-schema#comment','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#AnnotationProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (98,2,'http://www.w3.org/2000/01/rdf-schema#comment','http://www.w3.org/2000/01/rdf-schema#label','comment',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (99,2,'http://www.w3.org/2000/01/rdf-schema#comment','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#string',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (100,2,'http://www.w3.org/2000/01/rdf-schema#label','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#AnnotationProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (101,2,'http://www.w3.org/2000/01/rdf-schema#label','http://www.w3.org/2000/01/rdf-schema#label','label',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (102,2,'http://www.w3.org/2000/01/rdf-schema#label','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#string',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (103,2,'http://ns.ontowiki.net/SysOnt/userPassword','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#DatatypeProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (104,2,'http://ns.ontowiki.net/SysOnt/userPassword','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#FunctionalProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (105,2,'http://ns.ontowiki.net/SysOnt/userPassword','http://www.w3.org/2000/01/rdf-schema#comment','The password of an OntoWiki Account.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (106,2,'http://ns.ontowiki.net/SysOnt/userPassword','http://www.w3.org/2000/01/rdf-schema#label','password',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (107,2,'http://ns.ontowiki.net/SysOnt/userPassword','http://www.w3.org/2000/01/rdf-schema#domain','http://rdfs.org/sioc/ns#User',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (108,2,'http://ns.ontowiki.net/SysOnt/userPassword','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#string',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (109,2,'http://xmlns.com/foaf/0.1/accountName','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#DatatypeProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (110,2,'http://xmlns.com/foaf/0.1/accountName','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#FunctionalProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (111,2,'http://xmlns.com/foaf/0.1/accountName','http://www.w3.org/2000/01/rdf-schema#label','uid',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (112,2,'http://xmlns.com/foaf/0.1/accountName','http://www.w3.org/2000/01/rdf-schema#comment','This is the user identifier of an OntoWiki account which is used for login',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (113,2,'http://xmlns.com/foaf/0.1/accountName','http://www.w3.org/2000/01/rdf-schema#domain','http://rdfs.org/sioc/ns#User',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (114,2,'http://xmlns.com/foaf/0.1/accountName','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#string',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (115,2,'http://ns.ontowiki.net/SysOnt/hidden','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#DatatypeProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (116,2,'http://ns.ontowiki.net/SysOnt/hidden','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#FunctionalProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (117,2,'http://ns.ontowiki.net/SysOnt/hidden','http://www.w3.org/2000/01/rdf-schema#label','hidden',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (118,2,'http://ns.ontowiki.net/SysOnt/hidden','http://www.w3.org/2000/01/rdf-schema#comment','All resources (especially Models, Classes and Properties) can be hidden.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (119,2,'http://ns.ontowiki.net/SysOnt/hidden','http://www.w3.org/2000/01/rdf-schema#domain','http://www.w3.org/2002/07/owl#Thing',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (120,2,'http://ns.ontowiki.net/SysOnt/hidden','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#boolean',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (121,2,'http://ns.ontowiki.net/SysOnt/isFacet','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#DatatypeProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (122,2,'http://ns.ontowiki.net/SysOnt/isFacet','http://www.w3.org/2000/01/rdf-schema#label','is facet',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (123,2,'http://ns.ontowiki.net/SysOnt/isFacet','http://www.w3.org/2000/01/rdf-schema#comment','This property is a good candidate for beeing a facet in a instance list.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (124,2,'http://ns.ontowiki.net/SysOnt/isFacet','http://www.w3.org/2000/01/rdf-schema#domain','http://www.w3.org/1999/02/22-rdf-syntax-ns#Property',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (125,2,'http://ns.ontowiki.net/SysOnt/isFacet','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#boolean',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (126,2,'http://ns.ontowiki.net/SysOnt/isLarge','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#DatatypeProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (127,2,'http://ns.ontowiki.net/SysOnt/isLarge','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#FunctionalProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (128,2,'http://ns.ontowiki.net/SysOnt/isLarge','http://www.w3.org/2000/01/rdf-schema#label','is large',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (129,2,'http://ns.ontowiki.net/SysOnt/isLarge','http://www.w3.org/2000/01/rdf-schema#comment','When models are too big counting can be disabled and limits are added',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (130,2,'http://ns.ontowiki.net/SysOnt/isLarge','http://www.w3.org/2000/01/rdf-schema#domain','http://www.w3.org/2002/07/owl#Ontology',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (131,2,'http://ns.ontowiki.net/SysOnt/isLarge','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#boolean',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (132,2,'http://ns.ontowiki.net/SysOnt/rawConfig','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#DatatypeProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (133,2,'http://ns.ontowiki.net/SysOnt/rawConfig','http://www.w3.org/2000/01/rdf-schema#label','config',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (134,2,'http://ns.ontowiki.net/SysOnt/rawConfig','http://www.w3.org/2000/01/rdf-schema#comment','This property holds action configuration values beyond the rdf schema.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (135,2,'http://ns.ontowiki.net/SysOnt/rawConfig','http://www.w3.org/2000/01/rdf-schema#domain','http://ns.ontowiki.net/SysOnt/Action',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (136,2,'http://ns.ontowiki.net/SysOnt/rawConfig','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#string',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (137,2,'http://ns.ontowiki.net/SysOnt/prefix','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#DatatypeProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (138,2,'http://ns.ontowiki.net/SysOnt/prefix','http://www.w3.org/2000/01/rdf-schema#label','used prefix',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (139,2,'http://ns.ontowiki.net/SysOnt/prefix','http://www.w3.org/2000/01/rdf-schema#comment','This property describes namespace prefix configurations.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (140,2,'http://ns.ontowiki.net/SysOnt/prefix','http://www.w3.org/2000/01/rdf-schema#domain','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (141,2,'http://ns.ontowiki.net/SysOnt/prefix','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2001/XMLSchema#string',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (142,2,'http://ns.ontowiki.net/SysOnt/possibleDatatype','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (143,2,'http://ns.ontowiki.net/SysOnt/possibleDatatype','http://www.w3.org/2000/01/rdf-schema#label','possible datatype',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (144,2,'http://ns.ontowiki.net/SysOnt/possibleDatatype','http://www.w3.org/2000/01/rdf-schema#comment','Since it is not allowed to state more than one possible datatypes of a datatype property in OWL, you can use this relation. (not implemented yet)',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (145,2,'http://ns.ontowiki.net/SysOnt/possibleDatatype','http://www.w3.org/2000/01/rdf-schema#domain','http://www.w3.org/2002/07/owl#DatatypeProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (146,2,'http://ns.ontowiki.net/SysOnt/possibleDatatype','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2000/01/rdf-schema#Datatype',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (147,2,'http://ns.ontowiki.net/SysOnt/grantModelEdit','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (148,2,'http://ns.ontowiki.net/SysOnt/grantModelEdit','http://www.w3.org/2000/01/rdf-schema#label','editable model',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (149,2,'http://ns.ontowiki.net/SysOnt/grantModelEdit','http://www.w3.org/2000/01/rdf-schema#comment','Model Based Access Control: Which Models are allowed to edit (and read)',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (150,2,'http://ns.ontowiki.net/SysOnt/grantModelEdit','http://www.w3.org/2000/01/rdf-schema#domain','b1',NULL,NULL,NULL,0,1,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (151,2,'http://ns.ontowiki.net/SysOnt/grantModelEdit','http://www.w3.org/2000/01/rdf-schema#range','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (152,2,'http://ns.ontowiki.net/SysOnt/grantModelEdit','http://www.w3.org/2000/01/rdf-schema#subPropertyOf','http://ns.ontowiki.net/SysOnt/grantModelView',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (153,2,'http://ns.ontowiki.net/SysOnt/grantModelView','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (154,2,'http://ns.ontowiki.net/SysOnt/grantModelView','http://www.w3.org/2000/01/rdf-schema#label','readable model',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (155,2,'http://ns.ontowiki.net/SysOnt/grantModelView','http://www.w3.org/2000/01/rdf-schema#comment','Model Based Access Control: Which Models are allowed to read',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (156,2,'http://ns.ontowiki.net/SysOnt/grantModelView','http://www.w3.org/2000/01/rdf-schema#domain','b1',NULL,NULL,NULL,0,1,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (157,2,'http://ns.ontowiki.net/SysOnt/grantModelView','http://www.w3.org/2000/01/rdf-schema#range','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (158,2,'http://ns.ontowiki.net/SysOnt/denyModelEdit','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (159,2,'http://ns.ontowiki.net/SysOnt/denyModelEdit','http://www.w3.org/2000/01/rdf-schema#label','not editable model',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (160,2,'http://ns.ontowiki.net/SysOnt/denyModelEdit','http://www.w3.org/2000/01/rdf-schema#comment','Model Based Access Control: Which Models are NOT allowed to edit (and read)',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (161,2,'http://ns.ontowiki.net/SysOnt/denyModelEdit','http://www.w3.org/2000/01/rdf-schema#domain','b1',NULL,NULL,NULL,0,1,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (162,2,'http://ns.ontowiki.net/SysOnt/denyModelEdit','http://www.w3.org/2000/01/rdf-schema#range','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (163,2,'http://ns.ontowiki.net/SysOnt/denyModelView','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (164,2,'http://ns.ontowiki.net/SysOnt/denyModelView','http://www.w3.org/2000/01/rdf-schema#label','not readable model',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (165,2,'http://ns.ontowiki.net/SysOnt/denyModelView','http://www.w3.org/2000/01/rdf-schema#comment','Model Based Access Control: Which Models are NOT allowed to read',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (166,2,'http://ns.ontowiki.net/SysOnt/denyModelView','http://www.w3.org/2000/01/rdf-schema#domain','b1',NULL,NULL,NULL,0,1,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (167,2,'http://ns.ontowiki.net/SysOnt/denyModelView','http://www.w3.org/2000/01/rdf-schema#range','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (168,2,'http://ns.ontowiki.net/SysOnt/denyModelView','http://www.w3.org/2000/01/rdf-schema#subPropertyOf','http://ns.ontowiki.net/SysOnt/denyModelEdit',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (169,2,'http://ns.ontowiki.net/SysOnt/grantAccess','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (170,2,'http://ns.ontowiki.net/SysOnt/grantAccess','http://www.w3.org/2000/01/rdf-schema#label','grant access',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (171,2,'http://ns.ontowiki.net/SysOnt/grantAccess','http://www.w3.org/2000/01/rdf-schema#comment','Access Control: Which Actions are allowed to accessed?',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (172,2,'http://ns.ontowiki.net/SysOnt/grantAccess','http://www.w3.org/2000/01/rdf-schema#domain','b1',NULL,NULL,NULL,0,1,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (173,2,'http://ns.ontowiki.net/SysOnt/grantAccess','http://www.w3.org/2000/01/rdf-schema#range','http://ns.ontowiki.net/SysOnt/Action',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (174,2,'http://ns.ontowiki.net/SysOnt/denyAccess','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (175,2,'http://ns.ontowiki.net/SysOnt/denyAccess','http://www.w3.org/2000/01/rdf-schema#label','deny access',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (176,2,'http://ns.ontowiki.net/SysOnt/denyAccess','http://www.w3.org/2000/01/rdf-schema#comment','Action Based Access Control: Which Actions are NOT to be accessed?',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (177,2,'http://ns.ontowiki.net/SysOnt/denyAccess','http://www.w3.org/2000/01/rdf-schema#domain','b1',NULL,NULL,NULL,0,1,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (178,2,'http://ns.ontowiki.net/SysOnt/denyAccess','http://www.w3.org/2000/01/rdf-schema#range','http://ns.ontowiki.net/SysOnt/Action',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (179,2,'http://rdfs.org/sioc/ns#email','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (180,2,'http://rdfs.org/sioc/ns#email','http://www.w3.org/2000/01/rdf-schema#label','mbox',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (181,2,'http://rdfs.org/sioc/ns#email','http://www.w3.org/2000/01/rdf-schema#comment','A personal mailbox, ie. an Internet mailbox associated with exactly one owner, the first owner of this mailbox.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (182,2,'http://rdfs.org/sioc/ns#email','http://www.w3.org/2000/01/rdf-schema#domain','http://rdfs.org/sioc/ns#User',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (183,2,'http://rdfs.org/sioc/ns#email','http://www.w3.org/2000/01/rdf-schema#range','http://www.w3.org/2002/07/owl#Thing',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (184,2,'http://rdfs.org/sioc/ns#has_member','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (185,2,'http://rdfs.org/sioc/ns#has_member','http://www.w3.org/2000/01/rdf-schema#label','member',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (186,2,'http://rdfs.org/sioc/ns#has_member','http://www.w3.org/2000/01/rdf-schema#comment','The sioc:member property relates a sioc:Usergroup to a sioc:User that is a member of that group.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (187,2,'http://rdfs.org/sioc/ns#has_member','http://www.w3.org/2000/01/rdf-schema#domain','http://rdfs.org/sioc/ns#Usergroup',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (188,2,'http://rdfs.org/sioc/ns#has_member','http://www.w3.org/2000/01/rdf-schema#range','http://rdfs.org/sioc/ns#User',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (189,2,'http://ns.ontowiki.net/SysOnt/hiddenImports','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2002/07/owl#ObjectProperty',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (190,2,'http://ns.ontowiki.net/SysOnt/hiddenImports','http://www.w3.org/2000/01/rdf-schema#label','hidden imports',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (191,2,'http://ns.ontowiki.net/SysOnt/hiddenImports','http://www.w3.org/2000/01/rdf-schema#comment','Acts like owl:imports but is not part of the model itself.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (192,2,'http://ns.ontowiki.net/SysOnt/hiddenImports','http://www.w3.org/2000/01/rdf-schema#domain','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (193,2,'http://ns.ontowiki.net/SysOnt/hiddenImports','http://www.w3.org/2000/01/rdf-schema#range','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (194,2,'http://ns.ontowiki.net/SysOnt/Anonymous','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://rdfs.org/sioc/ns#User',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (195,2,'http://ns.ontowiki.net/SysOnt/Anonymous','http://www.w3.org/2000/01/rdf-schema#label','Anonymous',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (196,2,'http://ns.ontowiki.net/SysOnt/Anonymous','http://www.w3.org/2000/01/rdf-schema#comment','This special account identifies the anonymous user.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (197,2,'http://ns.ontowiki.net/SysOnt/SuperAdmin','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://rdfs.org/sioc/ns#User',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (198,2,'http://ns.ontowiki.net/SysOnt/SuperAdmin','http://www.w3.org/2000/01/rdf-schema#label','SuperAdmin',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (199,2,'http://ns.ontowiki.net/SysOnt/SuperAdmin','http://www.w3.org/2000/01/rdf-schema#comment','This special account is the SuperAdministrator. He has hard coded access to all models and actions and uses the user nick and paf8d8bc121572f3c16464892794fd9dcc',NULL,NULL,1,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (200,2,'http://ns.ontowiki.net/SysOnt/AnyModel','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://ns.ontowiki.net/SysOnt/Model',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (201,2,'http://ns.ontowiki.net/SysOnt/AnyModel','http://www.w3.org/2000/01/rdf-schema#label','AnyModel',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (202,2,'http://ns.ontowiki.net/SysOnt/AnyModel','http://www.w3.org/2000/01/rdf-schema#comment','This special model identifies any model.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (203,2,'http://ns.ontowiki.net/SysOnt/AnyAction','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://ns.ontowiki.net/SysOnt/Action',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (204,2,'http://ns.ontowiki.net/SysOnt/AnyAction','http://www.w3.org/2000/01/rdf-schema#label','AnyAction',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (205,2,'http://ns.ontowiki.net/SysOnt/AnyAction','http://www.w3.org/2000/01/rdf-schema#comment','This special action identifies any action.',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (206,2,'http://ns.ontowiki.net/SysOnt/RegisterNewUser','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://ns.ontowiki.net/SysOnt/Action',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (207,2,'http://ns.ontowiki.net/SysOnt/RegisterNewUser','http://www.w3.org/2000/01/rdf-schema#label','Register new User',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (208,2,'http://ns.ontowiki.net/SysOnt/RegisterNewUser','http://www.w3.org/2000/01/rdf-schema#comment','Register new users with application/register',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (209,2,'http://ns.ontowiki.net/SysOnt/ModelManagement','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://ns.ontowiki.net/SysOnt/Action',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (210,2,'http://ns.ontowiki.net/SysOnt/ModelManagement','http://www.w3.org/2000/01/rdf-schema#label','Model Management',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (211,2,'http://ns.ontowiki.net/SysOnt/ModelManagement','http://www.w3.org/2000/01/rdf-schema#comment','Create and remove models from the store',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (212,2,'http://ns.ontowiki.net/SysOnt/Login','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://ns.ontowiki.net/SysOnt/Action',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (213,2,'http://ns.ontowiki.net/SysOnt/Login','http://www.w3.org/2000/01/rdf-schema#label','Login',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (214,2,'http://ns.ontowiki.net/SysOnt/Login','http://www.w3.org/2000/01/rdf-schema#comment','Login to the OntoWiki application',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (215,2,'http://ns.ontowiki.net/SysOnt/Rollback','http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://ns.ontowiki.net/SysOnt/Action',NULL,NULL,NULL,0,0,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (216,2,'http://ns.ontowiki.net/SysOnt/Rollback','http://www.w3.org/2000/01/rdf-schema#label','Rollback',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (217,2,'http://ns.ontowiki.net/SysOnt/Rollback','http://www.w3.org/2000/01/rdf-schema#comment','Rollback changes on statements to a past version (needs Versioning)',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (218,1,'http://ns.ontowiki.net/SysOnt/','http://ns.ontowiki.net/SysOnt/prefix','rdfs=http://www.w3.org/2000/01/rdf-schema#',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (219,1,'http://ns.ontowiki.net/SysOnt/','http://ns.ontowiki.net/SysOnt/prefix','rdf=http://www.w3.org/1999/02/22-rdf-syntax-ns#',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (220,1,'http://ns.ontowiki.net/SysOnt/','http://ns.ontowiki.net/SysOnt/prefix','owl=http://www.w3.org/2002/07/owl#',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (221,1,'http://ns.ontowiki.net/SysOnt/','http://ns.ontowiki.net/SysOnt/prefix','foaf=http://xmlns.com/foaf/0.1/',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (222,1,'http://ns.ontowiki.net/SysOnt/','http://ns.ontowiki.net/SysOnt/prefix','sysont=http://ns.ontowiki.net/SysOnt/',NULL,NULL,NULL,0,2,'','',NULL);
INSERT INTO `tx_semantic_statement` VALUES (223,1,'http://ns.ontowiki.net/SysOnt/','http://ns.ontowiki.net/SysOnt/prefix','sioc=http://rdfs.org/sioc/ns#',NULL,NULL,NULL,0,2,'','',NULL);

/*!40000 ALTER TABLE `tx_semantic_statement` ENABLE KEYS */;
UNLOCK TABLES;
