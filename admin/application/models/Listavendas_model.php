<?php

class Listavendas_model extends CI_Model
{
	private $tabela = 'erp_listavendas';
	
	function __construct()
	{
		parent::__construct();

		$this->setTable('erp_listavendas' . $this->session->userdata('admin_id'));
	}

	public function setTable($table)
	{
		$this->tabela = $table;
	}
	
	public function getLista($where = null, $ordem = array('id'=>'ASC'), $limit = null)
	{
		if($limit)
		{
			$this->db->limit($limit);
		}
		if($where)
		{
			$this->db->where($where);
		}
		if($ordem)
		{
			$this->db->order_by(key($ordem), $ordem[key($ordem)]);
		}
		
		$dados = $this->db->get($this->tabela);

		return $dados->result();
	}

	public function deleteLista($reference)
	{
		$this->db->delete($this->tabela, $reference);
	}

	public function insertLista($dadostabela)
	{
		if(!$dadostabela)
		{
			return 'Erro: Os dados da tabela não foram informados';
		}
		if($dadostabela)
		{
			$insert = $this->db->insert($this->tabela, $dadostabela);

			if($insert)
			{
				return $this->db->insert_id();
			}
			else
			{
				return false;
			}
		}
	}
}