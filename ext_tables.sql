#
# Table structure for table 'tx_subforms_domain_model_buecherwunsch'
#
CREATE TABLE tx_subforms_domain_model_buecherwunsch (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	author varchar(255) DEFAULT '' NOT NULL,
	editor varchar(255) DEFAULT '' NOT NULL,
	publishing_year varchar(255) DEFAULT '' NOT NULL,
	issue varchar(255) DEFAULT '' NOT NULL,
	isbn varchar(20) DEFAULT '' NOT NULL,
	additional_data text,
	name varchar(255) DEFAULT '' NOT NULL,
	user_id varchar(20) DEFAULT '' NOT NULL,
	email_address varchar(255) DEFAULT '' NOT NULL,
	needed_for varchar(255) DEFAULT '' NOT NULL,
	deadline varchar(255) DEFAULT '' NOT NULL,
	tutor varchar(255) DEFAULT '' NOT NULL,
	faculty varchar(255) DEFAULT '' NOT NULL,
	institute_name varchar(255) DEFAULT '' NOT NULL,
	remarks text,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_subforms_domain_model_feedback'
#
CREATE TABLE tx_subforms_domain_model_feedback (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	page_id int(11) DEFAULT '0' NOT NULL,
	email_address varchar(255) DEFAULT '' NOT NULL,
	message text,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_subforms_domain_model_fragdiesub'
#
CREATE TABLE tx_subforms_domain_model_fragdiesub (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	page_id int(11) DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	topic varchar(255) DEFAULT '' NOT NULL,
	email_address varchar(255) DEFAULT '' NOT NULL,
	street varchar(255) DEFAULT '' NOT NULL,
	zip_city varchar(255) DEFAULT '' NOT NULL,
	message text,

	PRIMARY KEY (uid),
	KEY parent (pid)
);