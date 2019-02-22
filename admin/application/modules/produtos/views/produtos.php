<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Produtos'); ?>

	<div class="col-lg-9">
		<div class="modal add-receita add-despesa modal-produto verfluxo form-modal">
		   	<div class="modal-dialog">
				<div id="loading-modal"><?php $this->load->view('include_addprodutos') ?></div>
			</div>	
		</div>

		<div class="row">
			<div class="col">
				<button class="btn btn-success btn-receita" data-toggle="modal" data-target=".add-receita">
                   	<span class="">Cadastrar produto</span>
                </button>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card panel panel-default panel-table">
	                
					<div class="card-header">
						<div class="search">
							<div class="input-group">
			                   	<input type="text" class="form-control busca-produto" placeholder="Buscar produto...">
			                   	<span class="loader-busca"></span>
			               	</div>
						</div>

						<div class="header-buttons-options">
							<div style="float: left; margin: 0 5px">
								<button class="btn btn-primary-outline ks-no-text arquivo">
						            <span class="la la-file ks-icon"></span>
						        </button>

						        <div class="boxarquivo" style="display: none;">
						        	<button class="btn btn-success" name="export">
						        		<span class="la la-arrow-down ks-icon"></span>
                            			<span class="ks-text">Baixar Excel</span>
                            		</button>

						        	<a href="<?php echo base_url('importar/produtos') ?>" class="btn btn-info">
						        		<span class="la la-cloud-upload ks-icon"></span>
						        	 	<span class="ks-text">Importar</span>
						        	 </a>
						        </div>
							</div>

							<div class="filter-options">
							<form method="post" action="<?php echo base_url('produtos/CookieFiltroProduto') ?>">
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

							<button class="filterproduto btn btn-primary ks-no-text">
				        	    <span class="la la-filter ks-icon"></span>
				        	</button>
						</div>	
					</div>

	                <div class="card-block ks-browse ks-scrollable jspScrollable" style="min-height: 400px">
	                    	
	                    <div id="resultado"></div>

	                    <table class="table table-striped stacktable small-only listaprodutos">
	                        	<thead>
	                        		<th>
	                        			<label class="custom-control custom-checkbox ks-no-description">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </th>
	                        		<th><strong>ID</strong></th>
	                        		<th><strong>Nome</strong></th>
	                        		<th><strong>Estoque atual</strong></th>
	                        		<th><strong>Preço</strong></th>
	                        		<th><strong>Cod.</strong></th>
	                        	</thead>
							<tbody>
	                        	<?php foreach ($produtos as $v): ?>
		                        	<tr>
			                        	<td width="5">
			                        		<label class="custom-control custom-checkbox ks-no-description">
	                                            <input type="checkbox" class="custom-control-input">
	                                            <span class="custom-control-indicator"></span>
	                                        </label>
	                                    </td>
			                        	<td width="100"><?php echo $v->id ?></td>
			                        	<td width="200"><a href="<?php echo base_url('produtos/dadosproduto/'.$v->id) ?>"><?php echo $v->nome ?></td>
			                        	<td></td>
			                        	<td><?php echo '<span class="badge badge-pill badge-info">'.number_format($v->preco, 2).'</span>' ?></td>
			                        	<td><?php echo ($v->ref) ? $v->ref : '-' ?></td>
			                        </tr>
		                    	<?php endforeach; ?>
	                    	</tbody>
	                	</table>
	                </div>
	            </div>
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
	
<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
<?php $this->load->view('include_scriptjs') ?>
<?php echo get_message_cookie(); ?>

</html>