<?php
/**
 * @var Ct\Data\Subscription $subscription
 */
?>
<div class="card-views-exceeded">
  <div class="card-views-exceeded-img">
    <img src="<?php echo ct_image_to_base64('logo.png'); ?>" width="165" height="65" alt="Augmented Card">
  </div>
  <div class="card-views-exceeded-divider"></div>
  <div>Dear <span class="card-views-exceeded-text-medium"><?php echo esc_html($subscription->entity()->get_billing_first_name()); ?> <?php echo esc_html($subscription->entity()->get_billing_last_name()); ?></span>,<br>Your card view has expired.<br>You can renew your view count on the product page.</div>
  <div class="card-views-exceeded-url">
    <a href="<?php echo esc_url($subscription->entity()->get_view_order_url()); ?>"><?php echo esc_url($subscription->entity()->get_view_order_url()); ?></a>
  </div>
  <div class="card-views-exceeded-divider"></div>
  <div class="card-views-exceeded-footer">For more information, visit <a href="<?php echo site_url(); ?>">augmentedcards.com</a></div>
</div>

<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500');

    .card-views-exceeded {
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

    .card-views-exceeded img {
        max-width: 100%;
    }

    .card-views-exceeded-divider {
        max-width: 488px;
        height: 1px;
        margin: 20px auto;
        background-color: #ff6347;
    }

    .card-views-exceeded-text-medium {
        font-weight: 500;
    }

    .card-views-exceeded-url {
        display: inline-block;
        margin-top: 5px;
        padding: 5px 20px;
        background-color: #fafafc;
        border-radius: 2px;
    }

    .card-views-exceeded-url a {
        color: #197eff;
        letter-spacing: 0.26px;
        line-height: 26px;
        text-decoration: underline;
    }

    .card-views-exceeded-url a:hover {
        color: #0065e5;
    }

    .card-views-exceeded-img {
        margin: 0 auto 20px auto;
        max-width: 165px;
    }

    .card-views-exceeded-footer {
        color: #898989;
        font-size: 12px;
    }

    .card-views-exceeded-footer a {
        color: #898989;
        font-size: 12px;
    }

    .card-views-exceeded-footer a:hover {
        color: #707070;
    }

    @media (max-width: 480px) {
        .card-views-exceeded {
            padding: 25px;
        }
    }
</style>
