<!DOCTYPE html>
<html lang="pt-br">

<?php $this->load->view('head'); ?>

<body>
    <div class="ks-page">
    <div class="ks-body">
        <div class="ks-logo"><?php echo $titulo ?></div>

        <div class="card panel panel-default ks-light ks-panel ks-login">
            <div class="card-block">
                <form class="form-container" method="post">
                    <h4 class="ks-header"></h4>
                    <?php
                            if($msg = get_message_cookie())
                            {
                                echo $msg;
                            }
                    ?>
                    <div class="form-group">
                        <?php echo form_label('E-mail'); ?>
                        <?php echo form_input('email', set_value('email'), array('class'=>'form-control', 'placeholder'=>'E-mail')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Senha'); ?>
                        <?php echo form_input(array('name'=>'senha', 'type'=>'password'), '', array('class'=>'form-control', 'placeholder'=>'Senha')); ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" value="Entrar">
                    </div>
                    <div class="ks-text-center">
                        <a href="<?php echo base_url('cadastro') ?>">Cadastre-se</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="ks-footer">
        <span class="ks-copyright">&copy; <?php echo date('Y') ?> microGestor</span>
    </div>
    </div>
</body>

<?php $this->load->view('js'); ?>

</html>