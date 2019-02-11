<?php

class Produtos_model extends CI_Model
{
	private $tabela = 'erp_produtos';

	function __construct()
	{
		parent::__construct();

		$this->setTable('erp_produtos' . $this->session->userdata('admin_id'));
	}

	public function setTable($name_table)
	{	
		$this->tabela = $name_table;
	}

	public function countAll($where = null, $like = null)
	{
		if($where)
		{
			$this->db->where($where);
		}
		if($like)
		{
			$this->db->like($like);		
		}
		
		return $this->db->count_all($this->tabela);
	}

	public function insertProduto(array $dadostabela = null)
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

	public function deleteProduto($reference)
	{
		$this->db->delete($this->tabela, $reference);
	}
	
	public function updateProduto($data, $where)
	{
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update($this->tabela);
	}	

	public function getProdutos($where = null, $ordem = array('id'=>'ASC'), $limit = null, $start = null, $like = null)
	{
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
		if($like)
		{
			$this->db->like($like);
		}
		
		$dados = $this->db->get($this->tabela);

		return $dados->result();
	}
}