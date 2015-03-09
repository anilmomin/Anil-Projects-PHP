<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('ditchthepitchcontroller.php');


class ContactUs extends DitchthePitchController
{

	private $data;

	private $days;

	private $jsString = '';

	public function index()
	{
		$this->load->library(array('email', 'form_validation'));
		$this->load->library('tank_auth');
		
		if($this->input->post('post'))
		{
			
			// Form Validation for Fields
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('contact', 'Contact Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('msg', 'Message', 'trim|required|xss_clean');

			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->data['mb_data'] = $this->load->view('contactus', null, true);
				$this->addMainBodyData($this->data['mb_data']);
				$this->displayView();
			}
			else
			{
				$data = array(
						'name' => $this->input->post('firstname') . ' ' . $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'contact' => $this->input->post('contact'),
						'message' => $this->input->post('msg')
				);
				
				$this->email->from($this->input->post('email'));
				$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
				$this->email->to($this->config->item('webmaster_email', 'tank_auth'));
				$this->email->subject("Contact us");
				$this->email->message($this->load->view('admin/email/contactus-html', $data, TRUE));
				
				if($this->email->send())
				{
					// Thanks Message to the Sender
					$this->email->from($this->config->item('webmaster_email', 'tank_auth'));
					$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
					$this->email->to($this->input->post('email'));
					$this->email->subject("DitchthePitch - Contact Inquiry");
					$this->email->message($this->load->view('admin/email/thankyou', $data, TRUE));
					$this->email->send();
					$this->session->set_flashdata('message', "Message Send Successfully!");
					redirect('/');
				}
				else
				{
					$this->session->set_flashdata('errormsg', "Unable to Send Message!");
					redirect('/');
						
				}
					
				
			}
				
				
		}
		else
		{
			$this->data['mb_data'] = $this->load->view('contactus', null, true);
			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();
		}
	}
	
	
	public function registerwinery()
	{
		$this->load->library(array('email', 'form_validation'));
		$this->load->library('tank_auth');
		
		if($this->input->post('post'))
		{
		
			// Form Validation for Fields
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('winery', 'Winery', 'trim|required|xss_clean');
			$this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
			$this->form_validation->set_rules('msg', 'Message', 'trim|required|xss_clean');
		
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
		
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('errormsg', "Invalid Data provided");
				redirect('/');
			}
			else
			{
				$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'winery' => $this->input->post('winery'),
						'subject' =>  $this->input->post('subject'),
						'message' => $this->input->post('msg')
				);
		
					
				$this->email->from($this->input->post('email'));
				$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
				$this->email->to($this->config->item('webmaster_email', 'tank_auth'));
				$this->email->subject("Winery Registration - " . $this->input->post('subject'));
				$this->email->message($this->load->view('admin/email/winery-html', $data, TRUE));
							
				if($this->email->send())
				{
					// Thanks Message to the Sender
					$this->email->from($this->config->item('webmaster_email', 'tank_auth'));
					$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
					$this->email->to($this->input->post('email'));
					$this->email->subject("DitchthePitch - Winery Registration");
					$this->email->message($this->load->view('admin/email/thankyou', $data, TRUE));
					$this->email->send();
					$this->session->set_flashdata('message', "Message Send Successfully!");
					redirect('/');
				}
				else
				{
					$this->session->set_flashdata('errormsg', "Unable to Send Message!");
					redirect('/');
				}
		
		
			}
		
		
		}
					
	}

}