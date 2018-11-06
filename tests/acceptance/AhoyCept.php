<?php

$I = new AcceptanceTester($scenario);
$I->wantTo("ensure th' ship is docked in the Bay of Hoempaige");
$I->amOnPage('/');
$I->see('Bone MVC Framework');
$I->see('yet another PHP Framework');

$I->amOnPage('/fr_BE');
$I->see('Bone MVC Framework');
$I->see('Un framework PHP pour les pirates');
