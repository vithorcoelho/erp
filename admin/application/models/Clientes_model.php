<?php

class Clientes_model extends CI_Model
{
	private $tabela = 'erp_clientes';

	function __construct()
	{
		parent::__construct();

		$this->setTable('erp_clientes' . $this->session->userdata('admin_id'));
	}
	
	public function setTable($table)
	{
		$this->tabela = $table;
	}

	public function countAll()
	{
		return $this->db->count_all($this->tabela);
	}

	public function insertCliente(array $dadostabela = null)
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
	public function getClientes($where = null, $ordem = array('id'=>'ASC'), $limit = null, $start = null, $like = null)
	{
		if($where)
		{
			$this->db->where($where);
		}
		if($ordem)
		{
			$this->db->order_by(key($ordem), $ordem[key($ordem)]);
		}
		if($limit)
		{
			$this->db->limit($limit);
			
			if($start){
				$this->db->limit($limit, $start);
			}
		}
		if($like)
		{
			$this->db->like($like);
		}
		
		$dados = $this->db->get($this->tabela);

		return $dados->result();
	}
	public function deleteCliente($reference)
	{
		$this->db->delete($this->tabela, $reference);
	}

	public function updateCliente($data, $where)
	{
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update($this->tabela);
	}
}