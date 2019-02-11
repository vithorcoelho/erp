<!DOCTYPE html>
<html>
<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>

<?php body_open('Dashboard'); ?>
<div class="col-10">
    <div class="row">
                            <div class="col-xl-3">
                                <div class="card ks-card-widget ks-widget-payment-total-amount ks-green-light">
                                    <h5 class="card-header">
                                        Receita

                                        <div class="">
                                            +
                                        </div>
                                    </h5>
                                    <div class="card-block">
                                        <div class="ks-payment-total-amount-item-icon-block">
                                            <span class="la la-arrow-up ks-icon"></span>
                                        </div>

                                        <div class="ks-payment-total-amount-item-body">
                                            <div class="ks-payment-total-amount-item-amount">
                                                <span class="ks-amount" style="font-size: 25px"><?php echo number_format($receitamensal, 2, ',', '.');   ?></span>
                                            </div>
                                            <div class="ks-payment-total-amount-item-description">
                                                Mensal
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="card ks-card-widget ks-widget-payment-total-amount ks-pink-light">
                                    <h5 class="card-header">
                                        Despesas
                                        <div class="dropdown ks-control">
                                            +
                                        </div>
                                    </h5>
                                    <div class="card-block">
                                        <div class="ks-payment-total-amount-item-icon-block">
                                            <span class="la la-arrow-down ks-icon"></span>
                                        </div>

                                        <div class="ks-payment-total-amount-item-body">
                                            <div class="ks-payment-total-amount-item-amount">
                                                <span class="ks-amount" style="font-size: 25px"><?php echo number_format($customensal, 2, ',', '.'); ?></span>
                                            </div>
                                            <div class="ks-payment-total-amount-item-description">
                                               Mensal
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card ks-card-widget ks-widget-payment-total-amount ks-green-light">
                                    <h5 class="card-header">
                                        Vendas

                                        <div class="dropdown ks-control">
                                            +
                                        </div>
                                    </h5>
                                    <div class="card-block">
                                        <div class="ks-payment-total-amount-item-icon-block">
                                            <span class="la la-cart-arrow-down ks-icon"></span>
                                        </div>

                                        <div class="ks-payment-total-amount-item-body">
                                            <div class="ks-payment-total-amount-item-amount">
                                                <span class="ks-amount">23</span>
                                            </div>
                                            <div class="ks-payment-total-amount-item-description">
                                                Today status
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card ks-card-widget ks-widget-payment-total-amount ks-purple-light">
                                    <h5 class="card-header">
                                        Saldo atual

                                            
                                    </h5>
                                    <div class="card-block">
                                        <div class="ks-payment-total-amount-item-icon-block">
                                            <span class="la la-money ks-icon"></span>
                                        </div>

                                        <div class="ks-payment-total-amount-item-body">
                                            <div class="ks-payment-total-amount-item-amount">
                                                <span class="ks-amount">67</span>
                                            </div>
                                            <div class="ks-payment-total-amount-item-description">
                                                Today status
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
</div>
<?php body_close(); ?>

<?php echo modules::run('footer'); ?>
</html>
