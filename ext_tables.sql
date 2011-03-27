CREATE TABLE tx_semantic_cache_sparql_queryresult (
	id int(11) unsigned NOT NULL auto_increment,
	identifier varchar(250) DEFAULT '' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	content mediumtext,
	tags mediumtext,
	lifetime int(11) unsigned DEFAULT '0' NOT NULL,
	PRIMARY KEY (id),
	KEY cache_id (identifier)
) ENGINE=InnoDB;

CREATE TABLE tx_semantic_cache_sparql_queryresult_tags (
	id int(11) unsigned NOT NULL auto_increment,
	identifier varchar(128) DEFAULT '' NOT NULL,
	tag varchar(128) DEFAULT '' NOT NULL,
	PRIMARY KEY (id),
	KEY cache_id (identifier),
	KEY cache_tag (tag)
) ENGINE=InnoDB;

#
# Additional fields in tt_content
#
CREATE TABLE tt_content (
	tx_semantic_query tinyint(3) DEFAULT '0' NOT NULL,
	tx_semantic_layout varchar(255) DEFAULT '' NOT NULL,
	tx_semantic_customfile text,
	tx_semantic_paginate tinyint(4) unsigned DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_semantic_domain_model_sparql_endpoint (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	
	name varchar(255) DEFAULT '' NOT NULL,
	iri varchar(255) DEFAULT '' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_semantic_domain_model_rdf_namespace (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	prefix varchar(255) DEFAULT '' NOT NULL,
	iri varchar(255) DEFAULT '' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_semantic_domain_model_sparql_query (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	body text NOT NULL,
	tx_semantic_limit int(11) unsigned DEFAULT '0' NOT NULL,
	offset int(11) unsigned DEFAULT '0' NOT NULL,
	endpoint int(11) unsigned DEFAULT '0',
	namespaces int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_semantic_query_namespace_mm (
	uid int(10) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	tablenames varchar(255) DEFAULT '' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);