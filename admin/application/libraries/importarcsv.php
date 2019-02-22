<?php

/*
* Library responsável por pegar um arquivo CSV
* gerado em Excel e converter para "array" ou "json"
* sendo necessário apenas setar o campo do $_FILE 
* ou uma variável em formato CSV.
*/

class importarCSV
{
	public $filecsv;
	public $encodecsv;
	public $regracolunas;

	public function __construct()
	{
		// Instancia o CI para fazer o uso da biblioteca security
		$this->CI =& get_instance();
        $this->CI->load->library('security');
	}

	/*
	* Metodo que retorno o CSV em formato de array
	* $campo: campo ou variável em formato CSV
	* $colunas: colunas que será vericada e deve ser passa em array (array('coluna1', 'coluna2'))
	*/

	public function CSVencode($csv, $colunas)
	{
		if($csv)
		{
			if(@$_FILES[$csv])
			{
				$this->filecsv = fopen($_FILES[$csv]['tmp_name'], "r");
				$this->regracolunas = $colunas;
				$this->buildArray($this->filecsv);

				return $this->encodecsv;
			}
			else
			{
				echo 'O arquivo não existe';
			}
		}
		else
		{
			echo 'Não existe nenhum arquivo para importar';
		}
	}

	private function buildArray($handle)
	{
			$csv = fgetcsv($handle, 1000, ";");

			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
			{
				foreach ($data as $key => $value)
				{
					$csv[$key] = strtolower($csv[$key]);

					foreach ($this->regracolunas as $t)
					{
						if($csv[$key] == strtolower($t))
						{
							$array[$csv[$key]] = $this->CI->security->xss_clean(htmlspecialchars(trim($value)));
						}
					}
				}
				
				if(!empty($array))
				{
					$this->encodecsv[0][] = $array;
				}
				else
				{
					$this->encodecsv['error'] = 'Arquivo invalido ou não corresponde às regras';

					return false;
				}
			}
			fclose($handle);
	}
}