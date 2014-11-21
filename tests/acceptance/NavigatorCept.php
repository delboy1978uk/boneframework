<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo("check th' navigator can sail to URIsland");
$I->amOnPage('/error/not-authorised');
$I->see('WALK THE PLANK');
