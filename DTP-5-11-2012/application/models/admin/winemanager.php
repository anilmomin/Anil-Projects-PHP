<?php

require_once 'adminmodel.php';

class WineManager extends AdminModel
{
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = TABLE_WINES;
		
		
		$this->addPrimaryKey('wineId');
		
		$this->load->library('image_lib');
		
		$this->load->helper('generatecode');
		
	}	
	
	public function insertWines($wines)
	{
		if ($this->db->insert($this->tableName, $wines))
			return true;
		else
			return false;
	}
	
	
	
	public function getwinedata($wineId = null)
	{
		$this->db->select('wineId, wineUniqueId, wineName, wineVintage, wineStyle, wineDescription, winePrice, wineImage, w.wineryId, wineryName, r.regionId, regionName,winePitch,wineWithoutPitch,wineDdPValue')->from( $this->tableName );
		$this->db->join('regions r', 'r.regionId = wines.regionId');
		$this->db->join('wineries w', 'w.wineryId = wines.wineryId');
		
		if($wineId)
			$this->db->where('wineId', $wineId);	
		
		$results = $this->db->get();
	
		if($results)
			return $results->result();
		else
			return false;
	}

	public function getWine($wineName)
	{
		$this->db->select('wineId');
		$this->db->from($this->tableName);
		$this->db->like('wineName', $wineName);
		$this->db->limit(1);
		$result = $this->db->get();
		$result = $result->row();
		
		if(!empty($result))
			return $result;
		else
			return null;
	}
	
	public function getAll ($columnNames = '*', $limitx = null, $limity = null)

	{

		$this->db->select($columnNames);

		

		if ($limitx != null && $limity != null)

		{

			$this->db->limit($limitx, $limity);

		}

		else if (!empty($limitx))

		{

			$this->db->limit($limitx);

		}

		$this->db->order_by("wineId", "desc");

		$query = $this->db->get($this->tableName);

		
		if ($query)
		{
			if ($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return null;
			}
		}
		
		return null;

	}
	
	public function deletewines($winescheduleId)
	{
		$this->db->where($winescheduleId);
		
		if ($this->db->delete($this->tableName))
			return $this->db->affected_rows();
		else
			return false;
	}
	
	
	public function getwineByIds($wineIds, $limitx = null, $limity = null)
	{
		$this->db->select('*');
		$this->db->where_in('wineId', $wineIds);
		
		if($limitx || $limity)
		{
			
			$this->db->limit($limitx, $limity);
			$this->db->order_by('wineId', 'desc');
		}
		
		$result = $this->db->get('wines');
		
		if($result)
			return $result->result();	
		else
			return null;
		
	}
	
	public function processPic()
	{
		
		//Get File Data Info
		$uploads = array($this->upload->data());
		
		//Move Files To User Folder
		foreach($uploads as $key[] => $value)
		{
			
			//Gen Random code for new file name
			$randomcode = generate_code(12);
			
			$newimagename = $randomcode.$value['file_ext'];
			
			//Creat Thumbnail
			$config['image_library'] = 'GD2';
			$config['source_image'] = $value['full_path'];
			$config['create_thumb'] = TRUE;
			$config['thumb_marker'] = '_tn';
			$config['master_dim'] = 'width';
			$config['quality'] = 85;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 145;
			$config['height'] = 196;
			$config['new_image'] = './uploads/wines/'.$newimagename;

			
			$this->image_lib->initialize($config);
			
			$this->image_lib->resize();
			
			//Move Uploaded Files with NEW Random name
			rename($value['full_path'],'./uploads/wines/'.$newimagename);
			
			//Make Some Variables for Database
			$image = array();
			$image['wineImage'] = $newimagename;
			$image['winesmallImage'] = $randomcode.'_tn'.$value['file_ext'];

			return $image;
		}
		
		
	}
}