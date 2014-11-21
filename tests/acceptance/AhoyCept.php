<?php

$I = new AcceptanceTester($scenario);
$I->wantTo("ensure th' ship is docked in the Bay of Hoempaige");
$I->amOnPage('/');
$I->see('Bone MVC Framework');
