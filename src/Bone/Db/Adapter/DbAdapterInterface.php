<?php

namespace Bone\Db\Adapter;

interface DbAdapterInterface
{
    public function __construct($credentials);
    public function openConnection();
    public function closeConnection();
    public function isConnected();
    public function executeQuery();
}