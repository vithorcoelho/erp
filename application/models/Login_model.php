<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
	protected $tabela = 'sys_users';

	public function __construct()
	{
		parent::__construct();
	}

	public function getUser($column, $where = null)
	{
		// Consulta da tabela options do banco de dados
		// SELECT * FROM options WHERE option_name = $option_name LIMIT 1
		if($where)
		{
			$this->db->where($where);
		}
		$query = $this->db->get($this->tabela, 1);	
		
		if($query->num_rows() == 1):
			$row = $query->row();
			return $row->$column;
		else:
			return NULL;
		endif;
	}
}