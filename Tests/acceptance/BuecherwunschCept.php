<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that required fields are filled');
$I->amOnPage('/neu-hier/formular/');
$I->fillField('formhandler[isbn]', '9783955616083');
$I->sendAjaxGetRequest('http://www.dev/?eID=buecherwunsch&isbn=9783955616083');
$I->cantSeeInField('formhandler[publishingYear]', '2008');
$I->fillField('formhandler[name]', 'TEST');
$I->fillField('formhandler[userId]', '3201085403');
$I->fillField('formhandler[email]', 'pfennigstorf@sub.uni-goettingen.de');
$I->fillField('formhandler[deadline]', '10.10.2052');
$I->fillField('formhandler[tutor]', 'Wolfram Horstmann');
$I->fillField('formhandler[instituteName]', 'SUB');
$I->selectOption('faculty', 'Chemie');
$I->click('formhandler[step-2-next]');
$I->see('Form');
