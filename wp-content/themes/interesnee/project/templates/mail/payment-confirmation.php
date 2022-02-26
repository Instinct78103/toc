<?php
/**
 * @var string $url
 * @var WC_Order $order
 */
?>
<div class="payment-confirmation">
  <div class="payment-confirmation-img">
    <img src="<?php echo ct_image_to_base64('logo.png'); ?>" width="165" height="65" alt="Augmented Card">
  </div>
  <div class="payment-confirmation-divider"></div>
  <div>Dear <span class="payment-confirmation-text-medium"><?php echo esc_html($order->get_billing_first_name()); ?> <?php echo esc_html($order->get_billing_last_name()); ?></span>,<br>please confirm renewal payment on Augmented Card website.</div>
  <div class="payment-confirmation-url">
    <a href="<?php echo esc_url($url); ?>"><?php echo esc_url($url); ?></a>
  </div>
  <div class="payment-confirmation-divider"></div>
  <div class="payment-confirmation-footer">For more information, visit <a href="<?php echo site_url(); ?>">augmentedcards.com</a></div>
</div>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500');

    .payment-confirmation {
        max-width: 600px;
        padding: 50px 25px;
        margin: 0 auto;
        color: #3a3a3a;
        font-family: Ubuntu, serif;
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 0;
        line-height: 24px;
        text-align: center;
    }

    .payment-confirmation img {
        max-width: 100%;
    }

    .payment-confirmation-divider {
        max-width: 488px;
        height: 1px;
        margin: 20px auto;
        background-color: #ff6347;
    }

    .payment-confirmation-text-medium {
        font-weight: 500;
    }

    .payment-confirmation-url {
        display: inline-block;
        margin-top: 5px;
        padding: 5px 20px;
        background-color: #fafafc;
        border-radius: 2px;
    }

    .payment-confirmation-url a {
        color: #197eff;
        letter-spacing: 0.26px;
        line-height: 26px;
        text-decoration: underline;
    }

    .payment-confirmation-url a:hover {
        color: #0065e5;
    }

    .payment-confirmation-img {
        margin: 0 auto 20px auto;
        max-width: 165px;
    }

    .payment-confirmation-footer {
        color: #898989;
        font-size: 12px;
    }

    .payment-confirmation-footer a {
        color: #898989;
        font-size: 12px;
    }

    .payment-confirmation-footer a:hover {
        color: #707070;
    }

    @media (max-width: 480px) {
        .payment-confirmation {
            padding: 25px;
        }
    }
</style>
