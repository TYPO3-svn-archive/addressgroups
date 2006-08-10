#
# Table structure for table 'tx_addressgroups_group'
#
CREATE TABLE tx_addressgroups_group (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	fe_group int(11) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	parent_group int(11) DEFAULT '0' NOT NULL,
	description text NOT NULL,
	
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL, 
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);




#
# Table structure for table 'tt_address_tx_addressgroups_group_mm'
# 
#
CREATE TABLE tt_address_tx_addressgroups_group_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tt_address'
#
CREATE TABLE tt_address (
	tx_addressgroups_group int(11) DEFAULT '0' NOT NULL
);