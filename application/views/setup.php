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
                            if($msg = get_msg())
                            {
                                echo $msg;
                            }
                    ?>
                    <div class="form-group">
                        <?php echo form_label('Nome'); ?>
                        <?php echo form_input('nome', set_value('nome'), array('class'=>'form-control', 'placeholder'=>'Nome')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Email'); ?>
                        <?php echo form_input(array('name'=>'email', 'type'=>'email'), set_value('email'), array('class'=>'form-control', 'placeholder'=>'Email')); ?>
                    </div>
                     <div class="form-group">
                        <?php echo form_label('Senha'); ?>
                        <?php echo form_password(array('name'=>'senha'), '', array('class'=>'form-control', 'placeholder'=>'Senha')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Repita a senha'); ?>
                        <?php echo form_password(array('name'=>'senha2'), '', array('class'=>'form-control', 'placeholder'=>'Senha')); ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" value="Cadastrar">
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