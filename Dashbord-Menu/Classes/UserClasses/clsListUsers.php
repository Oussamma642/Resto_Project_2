<?php
include_once 'clsUser.php';

class clsListUsers
{
    public static function ListUsers()
    {
        return clsUser::ListUsers();
    }
}