<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const USER_TABLE_NAME = "users";
    const USER_ID_ATTR	= "userId";
    protected $table = self::USER_TABLE_NAME;
	protected $primaryKey = self::USER_ID_ATTR;
}