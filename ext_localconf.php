<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 *  $Id: ext_localconf.php 1842 2012-04-18 13:32:39Z pfennigstorf $
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
 * ************************************************************* */
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Buecherwunsch Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Subugoe.' . $_EXTKEY,
		'Buecherwunsch',
		array(
				'Buecherwunsch' => 'index, create'
		),
		array(
				'Buecherwunsch' => 'index, create'
		)
);

// Feedback Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Subugoe.' . $_EXTKEY,
		'Feedback',
		array(
				'Feedback' => 'index, create',
		),
		array(
				'Feedback' => 'index, create',
		)
);

// Frag die Sub Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Subugoe.' . $_EXTKEY,
		'Fragdiesub',
		array(
				'FragDieSub' => 'index, create',
		),
		array(
				'FragDieSub' => 'index, create',
		)
);

// statistik script ?eID=statistik
$TYPO3_CONF_VARS['FE']['eID_include']['buecherwunsch'] = 'EXT:subforms/Classes/Service/MetadataService.php';
