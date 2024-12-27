<?php

include_once 'clsReservation.php';

class clsListReservation
{
    public static function LstReservation()
    {
        return clsReservation::ListReservation();
    }
}