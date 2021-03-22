<?php
declare(strict_types = 1);

function db(): DB{
	return new DB();
}

function conn(): ?PDO{
	return DB::CONN();
}

