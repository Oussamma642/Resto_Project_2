<?php

include_once '../UserClasses/clsUser.php';

class clsClient extends clsUser
{
    private $id;
    private $fname; 
    private $lname; 
    private $email; 
    private $pswd; 
    private $phone;
    private $role; 
    private $prmsn;

    public function __construct(
    $id=null,
    $fname='', 
    $lname='', 
    $email='', 
    $pswd='', 
    $phone='' ,
    $role='', 
    $prmsn=0)
    {
        $this->id=$id;
        $this->fname=$fname;
        $this->lname=$lname;
        $this->email=$email;
        $this->pswd=$pswd;
        $this->phone=$phone;
        $this->role=$role;
        $this->prmsn=$prmsn;
        
    }
    
}