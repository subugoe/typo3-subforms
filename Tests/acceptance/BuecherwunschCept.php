<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that required fields are filled');
$I->amOnPage('/neu-hier/formular/');
$I->fillField('tx_subforms_buecherwunsch[buecherwunsch][isbn]', '9783955616083');
$I->sendAjaxGetRequest('http://www.dev/?eID=buecherwunsch&isbn=9783955616083');
$I->cantSeeInField('tx_subforms_buecherwunsch[buecherwunsch][publishingYear]', '2008');
$I->fillField('tx_subforms_buecherwunsch[buecherwunsch][name]', 'TEST');
$I->fillField('tx_subforms_buecherwunsch[buecherwunsch][userId]', '3201085403');
$I->fillField('tx_subforms_buecherwunsch[buecherwunsch][emailAddress]', 'pfennigstorf@sub.uni-goettingen.de');
$I->fillField('tx_subforms_buecherwunsch[buecherwunsch][deadline]', '10.10.2052');
$I->fillField('tx_subforms_buecherwunsch[buecherwunsch][tutor]', 'Wolfram Horstmann');
$I->fillField('tx_subforms_buecherwunsch[buecherwunsch][instituteName]', 'SUB');
$I->selectOption('tx_subforms_buecherwunsch[buecherwunsch][faculty]', 'Chemie');
$I->click('submit');
$I->see('Form');
