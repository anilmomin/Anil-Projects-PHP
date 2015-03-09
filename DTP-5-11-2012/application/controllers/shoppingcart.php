<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('ditchthepitchcontroller.php');


class ShoppingCart extends DitchthePitchController {

	private $data;
	private $jsString;

	public function __construct()
	{
		parent::__construct();

		$this->data = array();
		
		$this->jsString = '';
		
		$this->load->library(array('tank_auth', 'cart', 'form_validation'));
		
		$this->load->Model(array('admin/WineManager'));

	}
	
	
	public function addtomulti()
	{
		$quantity = $this->input->post('quantity');
		$wines = $this->input->post('wineId');
		$linkback = $this->input->post('link');
		
		sort($wines);
		sort($quantity);
		sort($linkback);
		
		if (!empty($quantity[0]) && is_numeric($quantity[0]))
		{
			$winesdata = $this->WineManager->getByPrimaryKey(array('wineId' => $wines[0]));
			$currentQuantity = $winesdata[0]->wineQuantity - $quantity[0]; 
			//$winedesc = $this->WineManager->getDescByPrimaryKey(8);
			
			
			if($currentQuantity >= 0)
			{
				$cart[] = array (
							'id' => $wines[0],
							'qty' => $quantity[0],
							'price' => $winesdata[0]->winePrice,
							'name' => $winesdata[0]->wineName." ".$winesdata[0]->wineVintage." ".$winesdata[0]->wineStyle,
							);
				$this->cart->insert($cart);
				$this->session->set_flashdata('message', $quantity[0] ."x6 pack of " . $winesdata[0]->wineName ." have been added to your cart");
				redirect($linkback[0]);
			}
			else
			{
				$this->session->set_flashdata('errormsg', "{$winesdata[0]->wineName} is out of Stock!");
				redirect($linkback[0]);
			}
		}
		else
		{
			$this->session->set_flashdata('errormsg', "Invalid Quantity Entered");
			redirect($linkback[0]);
		}
	
	}
			
	
	
	public function addtocart($wineId = null, $urlcode = 'a',$quantity=1)
	{
		$primaryKey = array('wineId' => $wineId);
		$wines = $this->WineManager->getByPrimaryKey($primaryKey);
		$wines = $wines[0];
		$redirectURL = '';
		$currentQuantity = $wines->wineQuantity - 1;
		
		if($currentQuantity >= 0)
		{
			$cartObj = array( 
				   'id'      => $wines->wineId,
	               'qty'     => $quantity,
	               'price'   => $wines->winePrice,
	              	'name' => $wines->wineName." ".$wines->wineVintage." ".$wines->wineStyle
				  );
			
			$this->cart->insert($cartObj);
			$this->session->set_flashdata('message', "1 x 6 pack of $wines->wineName is addedd to your cart");
			switch ($urlcode)
			{
				case 'b':
					$redirectURL = "winedetails/index/$wines->wineId/1/";
					break;
				default:
					$redirectURL = '';
					break;
			}
			redirect(site_url($redirectURL));
		}
		else
		{
			$this->session->set_flashdata('errormsg', "$wines->wineName is out of Stock!");
			redirect(site_url($redirectURL));
		}
	}
	
	public function updatecart()
	{
		
		$rowarray = $this->input->post('rowid');
		$quantityarray = $this->input->post('qty');
		
		for($i = 0; $i < count($rowarray); $i++)
		{
			$updateObj[] = array(
						'rowid'   => $rowarray[$i],
						'qty'     => $quantityarray[$i]
						);
			
		}
		
		$this->cart->update($updateObj);
		$this->session->set_flashdata('message', "Cart updated successfully.");
		redirect(site_url('shoppingcart/displaycart'));
	}
	
	public function deletecartitem($rowId = null)
	{
		$rowarray = $this->input->post('rowid');
		$updateObj[] = array(
				'rowid'   => $rowId,
				'qty'     => 0
		);
		
		$this->cart->update($updateObj);
		$this->session->set_flashdata('message', "Cart updated successfully.");
		redirect(site_url('shoppingcart/displaycart'));
	}
	
	
	public function displaycart()
	{
		$this->load->library('Paypal_IPN');
		$this->data['paypalform']  = $this->_form();
		$this->data['mb_data'] = $this->load->view('cart', $this->data, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();		
	}
	
	private function _form()
	{
	
		$this->paypal_ipn->add_field('business','phil@ditchthepitch.com.au'); // Business Email
	
		$this->paypal_ipn->add_field('return',base_url().'shoppingcart/thanks'); // Return URL
	
		$this->paypal_ipn->add_field('cancel_return', base_url().'shoppingcart/cancel'); // Cancel URL
	
		$this->paypal_ipn->add_field('notify_url', base_url().'shoppingcart/ipn'); // <-- IPN url
		
		$this->paypal_ipn->add_field('rm','2');			  // Return method = POST
		
		$this->paypal_ipn->add_field('cmd','_cart');
		
		$this->paypal_ipn->add_field('currency_code', 'AUD');
	
		//$this->paypal_ipn->add_field('custom', "asdf");  // Optional
		$fieldcount = 1;
		
		foreach ($this->cart->contents() as $items)
		{
			$this->paypal_ipn->add_field('item_number_'.$fieldcount, $items['id']); // Product Number
			
			$this->paypal_ipn->add_field('item_name_'.$fieldcount, $items['name']); // Product Name
			
		
			$this->paypal_ipn->add_field('quantity_'.$fieldcount, $items['qty']); // Quantity
		
			$this->paypal_ipn->add_field('amount_'.$fieldcount, $items['price']); // Price
			
			$fieldcount++;
		}
	
		$this->paypal_ipn->add_field('upload', '1');
	
		// if you want an image button use this:
		$this->paypal_ipn->image();
	
		// otherwise, don't write anything or (if you want to
		// change the default button text), write this:
		// $this->paypal_ipn->button('Click to Pay!');
	
		return $this->paypal_ipn->paypal_form();
	
	}
	
	function cancel()
	{
		$this->data['mb_data'] = $this->load->view('cancelpayment', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}
	
	function success()
	{
		// This is where you would probably want to thank the user for their order
		// or what have you.  The order information at this point is in POST
		// variables.  However, you don't want to "process" the order until you
		// get validation from the IPN.  That's where you would have the code to
		// email an admin, update the database with payment status, activate a
		// membership, etc.
	
		// You could also simply re-direct them to another page, or your own
		// order status page which presents the user with the status of their
		// order based on a database (which can be modified with the IPN code
		// below).
	
		$data['pp_info'] = $this->input->post();
		$this->session->set_userdata('info', $data['pp_info']);
		
		$this->load->Model('admin/WineManager');
		$updateQuantity = array();
		$cartcontents = $this->cart->contents();
		$wineIds = array();
		$rowId = array();
		
		// get all the wine ids from the cart
		foreach ($cartcontents as  $value)
		{
			$rowId[] = $value['rowid'];
			$wineIds[] = $value['id'];
		}
		
		$wineQuantity = $this->WineManager->getwineByIds($wineIds); // get all the wines of the cart
		array_multisort($wineIds, $cartcontents);
		$cartcontents = array_values($cartcontents);
		
		for ($i = 0; $i < count($wineQuantity); $i++)
		{
			
			$newQuantity = $wineQuantity[$i]->wineQuantity - $cartcontents[$i]['qty'];
			
			if($newQuantity >= 0)
				$updateQuantity = array('wineId' => $wineQuantity[$i]->wineId, 'wineQuantity' => $newQuantity);
			
			$this->WineManager->update($updateQuantity);
		}
		
	}
	
	function test()
	{
		$this->load->library('Paypal_IPN');
		$this->paypal_ipn->updateQuantity();
	}
	
	
	/// IPN Function
	/// This function is called when the transaction is completed
	function ipn()
	{
		$this->load->library(array('Paypal_IPN', 'email')); // Load the library
	
		// Try to get the IPN data.
		if ($this->paypal_ipn->validateIPN())
		{
	
			// Succeeded, now let's extract the order
			$this->paypal_ipn->extractOrder();
	
			// And we save the order now (persist and extract are separate because you might only want to persist the order in certain circumstances).
			$this->paypal_ipn->saveOrder();
			
			// Now let's check what the payment status is and act accordingly
			if ($this->paypal_ipn->orderStatus == "PAID")
			{
				
				$this->paypal_ipn->updateQuantity();
				$this->cart->destroy();
				
				// Configure to send HTML emails.
				$mail_config['mailtype'] = 'html';
				$this->email->initialize($mail_config);
	
				// Prepare the variables to populate the email template:
				$data = $this->paypal_ipn->order;
				$data['items'] = $this->paypal_ipn->orderItems;
	
				// Now construct the email
				foreach($data['items'][0] as $key => $items)
				$emailBody .= $key . "=>". $items ."<br/>"; //$this->smarty->view('confirmation_email.tpl', $data, TRUE); // You'll have to create your own email template using Smarty, Twig or similar
	
				// Finish configuring email contents and send.
				$this->email->to($data['payer_email'], ($data['first_name'] . ' ' . $data['last_name']));
				$this->email->bcc('anilmomin87@gmail.com');
				$this->email->from('anilmomin87@gmail.com', 'CHANGEME');
				$this->email->subject('Order confirmation');
				$this->email->message($emailBody);
				$this->email->send();
			}
		}
		else // Just redirect to the root URL
		{
			$this->load->helper('url');
			redirect('/', 'refresh');
		}
	}
	
	
	
	// Thanks page
	function thanks()
	{
		$this->data['mb_data'] = $this->load->view('thanks', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
		$this->cart->destroy();
	}
	
	
}
?>