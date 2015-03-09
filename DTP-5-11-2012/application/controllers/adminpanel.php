<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */


class AdminPanel extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
       
    }

    public function index()
    {
        redirect('admin/auth/login');
    }
}