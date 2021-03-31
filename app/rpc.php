<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace rpc\contract\user;

interface User
{
	public function get($name);
}

interface Pay
{
	public function run($money);
}



return ['user' => ['rpc\contract\user\User', 'rpc\contract\user\Pay']];