<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Clientes'); ?>

	<div class="modal fade add-cliente form-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	   	<div class="modal-dialog modal-lg">
	       	<div class="modal-content">
				<div id="loading-modal"><?php $this->load->view('modaladdclientes')?></div>
			</div>
		</div>	
	</div>

	<div class="col-lg-9">
		<div class="row">
			<div class="col">
				<button class="btn btn-success btn-cliente" data-toggle="modal" data-target=".add-cliente">
                    <span class="">Adicionar cliente</span>
                </button>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card panel panel-default panel-table">
					<div class="card-header">
						<div class="search">
							<div class="">
				               	<input type="text" class="form-control campobusca busca-cliente" placeholder="Buscar cliente..." name="buscacliente">
				               	<span class="loader-busca"></span>
				            </div>
						</div>

						<div class="filter">

							<div style="float: left; margin: 0 5px">
								<button class="btn btn-primary-outline ks-no-text arquivo">
						            <span class="la la-file ks-icon"></span>
						        </button>

						        <div class="boxarquivo" style="display: none;">
						        	<button class="btn btn-success" name="export">
						        		<span class="la la-download ks-icon"></span>
                            			<span class="ks-text">Download</span>
                            		</button>

						        	<a href="<?php echo base_url('clientes/importplanilha') ?>" class="btn btn-info">
						        		<span class="la la-cloud-upload ks-icon"></span>
						        	 	<span class="ks-text">Importar Clientes</span>
						        	 </a>
						        </div>
							</div>

							<div class="filter-options">
								<form method="post" action="<?php echo base_url() ?>clientes/filtercliente">
									<div class="form-group">
										<select class="form-control" name="limit">
											<option value="">Mostrar</option>
											<option value="75">75</option>
											<option value="100">100</option>
										</select>
									</div>
									<div class="form-group">
										<select class="form-control" name="order_name">
											<option value="id">Ordem por cadastro</option>
											<option value="nome">Ordem alfabetica</option>
										</select>
									</div>
									<div class="form-group">
										<select class="form-control" name="order">
											<option value="DESC">Decrescente</option>
											<option value="ASC">Crescente</option>
										</select>
									</div>
									<button class="btn btn-success">Aplicar</button>
								</form>
							</div>

							<button class="filtercliente btn btn-primary ks-no-text">
				        	    <span class="la la-filter ks-icon"></span>
				        	</button>
						</div>	
					</div>

					<div id="resultado"></div>

	                <div class="card-block ks-browse ks-scrollable jspScrollable listaclientes flash" style="min-height: 400px" tabindex="0">
	                    <table id="ks-datatable" cellspacing="0" width="100%" role="grid" aria-describedby="ks-datatable_info" style="width: 100%;" class="table table-striped stacktable small-only dataTable">
	                        <thead>
	                        	<th id="th-nome"><strong>Nome</strong></th>
	                        	<th id="th-email"><strong>Email</strong></th>
	                        	<th id="th-telefone"><strong>Telefone</strong></th>
	                        	<th id="th-endereco"><strong>Endereço</strong></th>
	                        </thead>
	                        <tbody>
	                        	<?php foreach ($clientes as $v): ?>
		                        <tr>
		                        	<td id="td-nome"><a href="<?php echo base_url('clientes/vercliente/'.$v->id) ?>"><?php echo $v->nome ?></a></td>
		                        	<td id="td-email"><?php echo ($v->email) ? '<strong>'.$v->email.'</strong>' : '-' ; ?></td>
		                        	<td id="td-telefone"><?php echo ($v->telefone) ? '<span class="badge badge-default-outline">'.$v->telefone.'</span>' : '-' ?></td>
		                        	<td id="td-endereco"><?php echo ($v->endereco) ? $v->endereco : '-' ?></td>
		                        </tr>
		                    	<?php endforeach; ?>
	                    	</tbody>
	                	</table>
	                </div>
	            </div>

	            <div class="row">
	            	<div class="col" style="margin: 50px 0;">
						<nav>       
							<?php echo $paginacao ?>
				        </nav>
			    	</div>
	            </div>
			</div>
		</div>
	</div>

<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
<?php $this->load->view('script_js'); ?>
<?php echo (@Get_msg() == 'excluido') ? '<script>msg_flutuante("Cliente excluido com sucesso!", "success")</script>' : null; ?>
</html>
