<!DOCTYPE html>
<html>
<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>

<?php body_open($titulo_header); ?>
<div class="col-9">
    <div class="row">
                        <div class="col-md-3">
                            <div class="ks-dashboard-widget ks-widget-amount-statistics ks-success">
                                <div class="ks-statistics">
                                    <span class="ks-amount" data-count-up="3119">R$<?php echo number_format($receitamensal, 2, ',', '.');   ?></span>
                                    <span class="ks-text">Receita mensal</span>
                                </div>
                                <div class="ks-percent ks-up"><span class="ks-text">0%</span></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="ks-dashboard-widget ks-widget-amount-statistics ks-danger">
                                <div class="ks-statistics">
                                    <span class="ks-amount" data-count-up="8201">R$<?php echo number_format($customensal, 2, ',', '.'); ?></span>
                                    <span class="ks-text">Despesa mensal</span>
                                </div>
                                <div class="ks-percent ks-up"><span class="ks-text">0%</span></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="ks-dashboard-widget ks-widget-amount-statistics ks-info">
                                <div class="ks-statistics">
                                    <span class="ks-amount" data-count-up="8201"><?php echo $qtdvendas ?></span>
                                    <span class="ks-text">Vendas mensal</span>
                                </div>
                                <div class="ks-percent ks-up"><span class="ks-text">0%</span></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="ks-dashboard-widget ks-widget-amount-statistics ks-white">
                                <div class="ks-statistics">
                                    <span class="ks-amount" data-count-up="8201">R$<?php echo number_format(($receitamensal - $customensal), 2, ',', '.') ?></span>
                                    <span class="ks-text">Saldo atual</span>
                                </div>
                                <div class="ks-percent ks-up"><span class="ks-text">0%</span></div>
                            </div>
                        </div>
                    </div>
</div>
<?php body_close(); ?>

<?php echo modules::run('footer'); ?>
</html>
