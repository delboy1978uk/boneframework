<?php
/**
 * Returns a list of fixtures by classname, in the order of their execution
 */

use Fixtures\LoadClients;
use Fixtures\LoadScopes;
use Fixtures\LoadUsers;

return [
    'fixtures' => [
        LoadUsers::class,
        LoadScopes::class,
        LoadClients::class,
    ],
];
