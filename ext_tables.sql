# TYPO3 Extension Manager dump 1.1
#
# Host: localhost    Database: introduction
#--------------------------------------------------------


#
# Table structure for table "tx_semantic_cache_sparql_queryresult"
#
CREATE TABLE tx_semantic_cache_sparql_queryresult (
	id int(11) unsigned NOT NULL auto_increment,
	identifier varchar(250) NOT NULL default '',
	crdate int(11) unsigned NOT NULL default '0',
	content mediumtext,
	tags mediumtext,
	lifetime int(11) unsigned NOT NULL default '0',
	PRIMARY KEY (id),
	KEY cache_id (identifier)
);


#
# Table structure for table "tx_semantic_cache_sparql_queryresult_tags"
#
CREATE TABLE tx_semantic_cache_sparql_queryresult_tags (
	id int(11) unsigned NOT NULL auto_increment,
	identifier varchar(128) NOT NULL default '',
	tag varchar(128) NOT NULL default '',
	PRIMARY KEY (id),
	KEY cache_id (identifier),
	KEY cache_tag (tag)
);


#
# Table structure for table "tt_content"
#
CREATE TABLE tt_content (
	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',
	t3ver_oid int(11) NOT NULL default '0',
	t3ver_id int(11) NOT NULL default '0',
	t3ver_wsid int(11) NOT NULL default '0',
	t3ver_label varchar(255) default '',
	t3ver_state tinyint(4) NOT NULL default '0',
	t3ver_stage int(11) NOT NULL default '0',
	t3ver_count int(11) NOT NULL default '0',
	t3ver_tstamp int(11) NOT NULL default '0',
	t3ver_move_id int(11) NOT NULL default '0',
	t3_origuid int(11) NOT NULL default '0',
	tstamp int(11) unsigned NOT NULL default '0',
	crdate int(11) unsigned NOT NULL default '0',
	cruser_id int(11) unsigned NOT NULL default '0',
	hidden tinyint(4) unsigned NOT NULL default '0',
	sorting int(11) unsigned NOT NULL default '0',
	CType varchar(30) default '',
	header varchar(255) default '',
	header_position varchar(6) default '',
	bodytext mediumtext,
	image text,
	imagewidth mediumint(11) unsigned NOT NULL default '0',
	imageorient tinyint(4) unsigned NOT NULL default '0',
	imagecaption text,
	imagecols tinyint(4) unsigned NOT NULL default '0',
	imageborder tinyint(4) unsigned NOT NULL default '0',
	media text,
	layout tinyint(3) unsigned NOT NULL default '0',
	deleted tinyint(4) unsigned NOT NULL default '0',
	cols tinyint(3) unsigned NOT NULL default '0',
	records text,
	pages tinytext,
	starttime int(11) unsigned NOT NULL default '0',
	endtime int(11) unsigned NOT NULL default '0',
	colPos tinyint(3) unsigned NOT NULL default '0',
	subheader varchar(255) default '',
	spaceBefore smallint(5) unsigned NOT NULL default '0',
	spaceAfter smallint(5) unsigned NOT NULL default '0',
	fe_group varchar(100) NOT NULL default '0',
	header_link varchar(255) default '',
	imagecaption_position varchar(6) default '',
	image_link text,
	image_zoom tinyint(3) unsigned NOT NULL default '0',
	image_noRows tinyint(3) unsigned NOT NULL default '0',
	image_effects tinyint(3) unsigned NOT NULL default '0',
	image_compression tinyint(3) unsigned NOT NULL default '0',
	altText text,
	titleText text,
	longdescURL text,
	header_layout varchar(30) NOT NULL default '0',
	text_align varchar(6) default '',
	text_face tinyint(3) unsigned NOT NULL default '0',
	text_size tinyint(3) unsigned NOT NULL default '0',
	text_color tinyint(3) unsigned NOT NULL default '0',
	text_properties tinyint(3) unsigned NOT NULL default '0',
	menu_type varchar(30) NOT NULL default '0',
	list_type varchar(36) NOT NULL default '0',
	table_border tinyint(3) unsigned NOT NULL default '0',
	table_cellspacing tinyint(3) unsigned NOT NULL default '0',
	table_cellpadding tinyint(3) unsigned NOT NULL default '0',
	table_bgColor tinyint(3) unsigned NOT NULL default '0',
	select_key varchar(80) default '',
	sectionIndex tinyint(3) unsigned NOT NULL default '0',
	linkToTop tinyint(3) unsigned NOT NULL default '0',
	filelink_size tinyint(3) unsigned NOT NULL default '0',
	section_frame tinyint(3) unsigned NOT NULL default '0',
	date int(10) unsigned NOT NULL default '0',
	splash_layout varchar(30) NOT NULL default '0',
	multimedia tinytext,
	image_frames tinyint(3) unsigned NOT NULL default '0',
	recursive tinyint(3) unsigned NOT NULL default '0',
	imageheight mediumint(8) unsigned NOT NULL default '0',
	rte_enabled tinyint(4) NOT NULL default '0',
	sys_language_uid int(11) NOT NULL default '0',
	tx_impexp_origuid int(11) NOT NULL default '0',
	pi_flexform mediumtext,
	l18n_parent int(11) NOT NULL default '0',
	l18n_diffsource mediumblob,
	uuid varchar(36) NOT NULL default '',
	tx_semantic_query tinyint(3) NOT NULL default '0',
	tx_semantic_layout varchar(255) NOT NULL default '',
	tx_semantic_customfile text,
	tx_semantic_paginate tinyint(4) unsigned NOT NULL default '0',
	PRIMARY KEY (uid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY parent (pid,sorting),
	KEY language (l18n_parent,sys_language_uid)
);


#
# Table structure for table "tx_semantic_domain_model_sparql_endpoint"
#
CREATE TABLE tx_semantic_domain_model_sparql_endpoint (
	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',
	name varchar(255) NOT NULL default '',
	iri varchar(255) NOT NULL default '',
	deleted tinyint(4) unsigned NOT NULL default '0',
	hidden tinyint(4) unsigned NOT NULL default '0',
	sys_language_uid int(11) NOT NULL default '0',
	l18n_parent int(11) NOT NULL default '0',
	l18n_diffsource mediumblob NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);


#
# Table structure for table "tx_semantic_domain_model_rdf_namespace"
#
CREATE TABLE tx_semantic_domain_model_rdf_namespace (
	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',
	prefix varchar(255) NOT NULL default '',
	iri varchar(255) NOT NULL default '',
	deleted tinyint(4) unsigned NOT NULL default '0',
	hidden tinyint(4) unsigned NOT NULL default '0',
	PRIMARY KEY (uid),
	KEY parent (pid)
);


#
# Table structure for table "tx_semantic_domain_model_sparql_query"
#
CREATE TABLE tx_semantic_domain_model_sparql_query (
	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',
	name varchar(255) NOT NULL default '',
	query text NOT NULL,
	tx_semantic_limit int(11) unsigned NOT NULL default '0',
	offset int(11) unsigned NOT NULL default '0',
	endpoint int(11) unsigned default '0',
	namespaces int(11) unsigned NOT NULL default '0',
	tstamp int(11) unsigned NOT NULL default '0',
	crdate int(11) unsigned NOT NULL default '0',
	deleted tinyint(4) unsigned NOT NULL default '0',
	hidden tinyint(4) unsigned NOT NULL default '0',
	t3ver_oid int(11) NOT NULL default '0',
	t3ver_id int(11) NOT NULL default '0',
	t3ver_wsid int(11) NOT NULL default '0',
	t3ver_label varchar(30) NOT NULL default '',
	t3ver_state tinyint(4) NOT NULL default '0',
	t3ver_stage tinyint(4) NOT NULL default '0',
	t3ver_count int(11) NOT NULL default '0',
	t3ver_tstamp int(11) NOT NULL default '0',
	t3_origuid int(11) NOT NULL default '0',
	sys_language_uid int(11) NOT NULL default '0',
	l18n_parent int(11) NOT NULL default '0',
	l18n_diffsource mediumblob NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);


#
# Table structure for table "tx_semantic_graph"
#
CREATE TABLE tx_semantic_graph (
	id int(10) unsigned NOT NULL auto_increment,
	uri varchar(160) NOT NULL default '',
	uri_r int(10) unsigned default '',
	base varchar(160) default '',
	base_r int(10) unsigned default '',
	PRIMARY KEY (id),
	UNIQUE unique_graph (uri)
);


#
# Table structure for table "tx_semantic_info"
#
CREATE TABLE tx_semantic_info (
	id tinyint(3) unsigned NOT NULL auto_increment,
	schema_id varchar(10) NOT NULL default '',
	PRIMARY KEY (id)
);


#
# Table structure for table "tx_semantic_literal"
#
CREATE TABLE tx_semantic_literal (
	id int(10) unsigned NOT NULL auto_increment,
	g int(10) unsigned NOT NULL default '',
	v longtext NOT NULL,
	vh char(32) NOT NULL default '',
	PRIMARY KEY (id),
	UNIQUE unique_lit (g,vh)
);


#
# Table structure for table "tx_semantic_statement"
#
CREATE TABLE tx_semantic_statement (
	id int(10) unsigned NOT NULL auto_increment,
	g int(10) unsigned NOT NULL default '',
	s varchar(160) NOT NULL default '',
	p varchar(160) NOT NULL default '',
	o varchar(160) NOT NULL default '',
	s_r int(10) unsigned default '',
	p_r int(10) unsigned default '',
	o_r int(10) unsigned default '',
	st tinyint(1) unsigned NOT NULL default '',
	ot tinyint(1) unsigned NOT NULL default '',
	ol varchar(10) NOT NULL default '',
	od varchar(160) NOT NULL default '',
	od_r int(10) unsigned default '',
	PRIMARY KEY (id),
	UNIQUE unique_stmt (g,s,p,o,st,ot,ol,od),
	KEY idx_g_p_o_ot (g,p,o,ot),
	KEY idx_g_o_ot (g,o,ot)
);


#
# Table structure for table "tx_semantic_uri"
#
CREATE TABLE tx_semantic_uri (
	id int(10) unsigned NOT NULL auto_increment,
	g int(10) unsigned NOT NULL,
	v longtext NOT NULL,
	vh char(32) NOT NULL default '',
	PRIMARY KEY (id),
	UNIQUE unique_uri (g,vh)
);


#
# Table structure for table "tx_semantic_versioning_actions"
#
CREATE TABLE tx_semantic_versioning_actions (
	id int(11) NOT NULL auto_increment,
	model varchar(255) NOT NULL default '',
	useruri varchar(255) NOT NULL default '',
	resource varchar(255) default '',
	tstamp int(11) NOT NULL,
	action_type int(11) NOT NULL,
	parent int(11),
	payload_id int(11),
	PRIMARY KEY (id)
);


#
# Table structure for table "tx_semantic_versioning_payloads"
#
CREATE TABLE tx_semantic_versioning_payloads (
	id int(11) NOT NULL auto_increment,
	statement_hash longtext,
	PRIMARY KEY (id)
);