<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_addressgroups_group'] = array(
	'ctrl' => $TCA['tx_addressgroups_group']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,fe_group,title,parent_group,description'
	),
	'feInterface' => $TCA['tx_addressgroups_group']['feInterface'],
	'columns' => array(
		'hidden' => array(
			'l10n_mode' => 'mergeIfNotBlank',	
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => array(
				'type' => 'check',
				'default' => '1'
			)
		),
		'fe_group' => array(		
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.fe_group',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.php:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.php:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'title' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:addressgroups/locallang_db.php:tx_addressgroups_group.title',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'parent_group' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:addressgroups/locallang_db.php:tx_addressgroups_group.parent_group',		
			'config' => array(
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_addressgroups_treeview->displayGroupTree',
				'treeView' => 1,
				'size' => 1,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 2,
				'foreign_table' => 'tx_addressgroups_group',
			)
		),
		'description' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:addressgroups/locallang_db.php:tx_addressgroups_group.description',		
			'config' => array(
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
			)
		),
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_addressgroups_group',
				'foreign_table_where' => 'AND tx_addressgroups_group.uid=###REC_FIELD_l18n_parent### AND tx_addressgroups_group.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'=> array(
				'type'=>'passthrough'
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2, parent_group;;;;3-3-3, description')
	),
	'palettes' => array(
		'1' => array('showitem' => 'fe_group')
	)
);
?>