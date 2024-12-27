<?php

include_once 'MainClass.php';

function OrderList()
{
    return clsOrders::LstOrders();
}
OrderList();