<?php

class Vendas_model extends CI_Model
{
	private $tabela = 'erp_vendas';
	
	function __construct()
	{
		parent::__construct();

		$this->setTable('erp_vendas'.$this->session->userdata('admin_id'));
	}
	
	public function setTable($table)
	{
		$this->tabela = $table;
	}

	public function getVendas($select = null, $where = null, $ordem = array('id'=>'ASC'), $limit = null, $start = null)
	{
		if($select)
		{
			$this->db->select($select);
		}
		if($limit)
		{
			$this->db->limit($limit);

			if($start)
			{
				$this->db->limit($limit, $start);
			}
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

	public function countAll($where = null)
	{
		if($where)
		{
			$this->db->where($where);
		}
		return $this->db->count_all($this->tabela);
	}

	public function deleteVenda($reference)
	{
		$this->db->delete($this->tabela, $reference);
	}

	public function insertVenda(array $dadostabela = null)
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