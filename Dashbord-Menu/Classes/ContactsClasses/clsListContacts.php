<?php

include_once 'clsContact.php';

class clsListContacts
{
    public static function ListContacts()
    {
        return clsContact::ListContacts();
    }
}