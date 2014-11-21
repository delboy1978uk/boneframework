<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo("ensure we get 404 messages!");
$I->amOnPage('/shiver/me/timbers');
$I->see('LOST AT SEA');
$I->amOnPage('/kraken');
$I->see('LOST AT SEA');
$I->amOnPage('/davie/jones');
$I->see('LOST AT SEA');