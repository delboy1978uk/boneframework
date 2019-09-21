<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo("ensure we get 404 messages!");
$I->amOnPage('/en_PI/shiver/me/timbers');
$I->see('LOST AT SEA');
$I->amOnPage('nl_BE/behold/the/kraken');
$I->see('LOST AT SEA');
$I->amOnPage('fr_BE/davie/jones');
$I->see('LOST AT SEA');