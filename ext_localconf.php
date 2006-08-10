<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_addressgroups_group=1
');

$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['addressgroups']['useStoragePid'] = 0;

t3lib_extMgm::addPItoST43($_EXTKEY,'pi1/class.tx_addressgroups_pi1.php','_pi1','list_type',1);

?>