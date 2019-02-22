<!DOCTYPE html>
<html>
<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>

<?php body_open($titulo_header); ?>
<div class="col-9">
    <div class="row">

        <div class="col-lg-3">
            <div class="card ks-widget-simple-weather-only ks-widget-payment-price-ratio" style="background: #20cc85">
                <span class="ks-icon la la-arrow-up"></span>
                <div class="ks-widget-simple-weather-only-body">
                    <div class="ks-widget-simple-weather-only-block-amount">
                        R$<?php echo number_format($receitamensal, 2, ',', '.');   ?>
                    </div>
                    <div class="ks-widget-simple-weather-only-location">
                        Receita mensal
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card ks-widget-simple-weather-only" style="background: #d03939">
                <span class="ks-icon la la-arrow-down"></span>
                <div class="ks-widget-simple-weather-only-body">
                    <div class="ks-widget-simple-weather-only-block-amount">
                        R$<?php echo number_format($customensal, 2, ',', '.'); ?>
                    </div>
                    <div class="ks-widget-simple-weather-only-location">
                        Despesa mensal
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card ks-widget-simple-weather-only" style="background: #339ad8">
                <span class="ks-icon la la-cart-arrow-down"></span>
                <div class="ks-widget-simple-weather-only-body">
                    <div class="ks-widget-simple-weather-only-block-amount">
                        <?php echo $qtdvendas ?>
                    </div>
                    <div class="ks-widget-simple-weather-only-location">
                        Vendas mensal
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card ks-widget-simple-weather-only ks-sunny">
                <span class="ks-icon la la-money"></span>
                <div class="ks-widget-simple-weather-only-body">
                    <div class="ks-widget-simple-weather-only-block-amount">
                        R$<?php echo number_format(($receitamensal - $customensal), 2, ',', '.') ?>
                    </div>
                    <div class="ks-widget-simple-weather-only-location">
                        Saldo atual
                    </div>
                </div>
            </div>
        </div>

</div>
<?php body_close(); ?>

<?php echo modules::run('footer'); ?>
</html>
