<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*  Atom Key.
*  
*  Please, don't change this if u don't know what is it
*/

$config['atom_key'] = "deliWHeCwJou0mPB8O6sI2E";



/**
* Main Settings
*/

$config['atom_clock'] = 1;
$config['atom_link_to_site'] = 1;



/**
*  Count login errors for all users. 1 DB query per login error
*/
$config['login_errors'] = 1;



/**
* login_errors_email (TRUE or valid E-mail): System send email to user, if someone filed to sign in
* login_errors_email_ip: System send email to user with someone IP address, work only if first param is TRUE.
*/
$config['login_errors_email'] = "";
$config['login_errors_email_ip'] = "";


$config['atom_name'] = "Балкони та Вікна";



/**
*  API
*
*  Only for clients, who in our maintanance. All this data is in the client system.
*
*/

$config['atom_api_url'] = "http://crm.perepelitsa.com.ua/api/";
$config['atom_client_id'] = 23;
$config['atom_client_api'] = "FHUNS8j8xesEvP^8uQqWV%S";
