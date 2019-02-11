<!DOCTYPE html>
<html lang="pt-br">

<?php $this->load->view('head'); ?>

<body style="background: url(<?php echo base_url('assets/images/fundo.png') ?>) no-repeat">
    <div class="opacity"></div>
    <div class="ks-page">
        <div class="row">
            <div class="col logo">
                <img src="<?php echo base_url('assets/images/logotipo.png') ?>">
                <div class="empresa">
                    <h3>microGestor</h3>
                </div>
            </div>
            <div class="col-2 entrar">
                <a href="<?php echo base_url('login') ?>">
                    <button class="btn ks-rounded" style="background: #781d8b">
                        Entrar
                    </button>
                </a>
            </div>
        </div>

        <div class="ks-body">
            <h2 class="titulo">O sistema de gestão simples e gratuito para micro e pequenos empreendedores</h2>
            
            <a href="<?php echo base_url('cadastro') ?>">
                <button class="btn btn-success ks-rounded btn-lg criar">
                Criar conta grátis
                </button>
            </a>
            
        </div>
 
        <div class="ks-footer">
            <span class="ks-copyright">&copy; <?php echo date('Y') ?> microGestor</span>
        </div>
       
    </div>
</body>

<?php $this->load->view('js'); ?>

</html>