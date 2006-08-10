<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


$TCA['tx_addressgroups_group'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:addressgroups/locallang_db.php:tx_addressgroups_group',		
		'label' => 'title',	
		
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		
		'sortby' => 'sorting',	
		'delete' => 'deleted',		
		'treeParentField' => 'parent_group',
		
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField'            => 'sys_language_uid',
		
		'enablecolumns' => array(		
			'disabled' => 'hidden',	
			'fe_group' => 'fe_group',
		),
		
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_addressgroups_group.gif',
	),
	'feInterface' => array(
		'fe_admin_fieldList' => 'hidden, fe_group, title, parent_group, description',
	)
);

$tempColumns = array(
	'tx_addressgroups_group' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:addressgroups/locallang_db.php:tt_address.tx_addressgroups_group',		
		'config' => array(
			'type' => 'select',
			'form_type' => 'user',
			'userFunc' => 'tx_addressgroups_treeview->displayGroupTree',
			'treeView' => 1,
			'foreign_table' => 'tx_addressgroups_group',
			'size' => 5,
			'autoSizeMax' => 25,
			'minitems' => 0,
			'maxitems' => 50,
			'MM' => 'tt_address_tx_addressgroups_group_mm',
		)
	),
);


t3lib_div::loadTCA('tt_address');
t3lib_extMgm::addTCAcolumns('tt_address',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tt_address','tx_addressgroups_group;;;;1-1-1');

// add flexform to pi1
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'pi_flexform';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages,recursive';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY .'_pi1', 'FILE:EXT:addressgroups/pi1/flexform.xml');


t3lib_extMgm::addPlugin(array('LLL:EXT:addressgroups/locallang_db.php:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');
t3lib_extMgm::addStaticFile($_EXTKEY, 'pi1/static/', 'Groups for tt_address');

if (TYPO3_MODE=='BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_addressgroups_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_addressgroups_pi1_wizicon.php';
	
			// class for displaying the group tree in BE forms.
	include_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_addressgroups_treeview.php');
	include_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_addressgroups_addfilestosel.php');

}

?>