<?php
/**
 * @var Ct\Data\Subscription $subscription
 */
?>
<div class="augmented-card">
  <div class="augmented-card-img">
    <img src="<?php echo ct_image_to_base64('logo.png'); ?>" width="165" height="65" alt="Augmented Card">
  </div>
  <div class="augmented-card-divider"></div>
  <div>Dear <span class="augmented-card-text-medium"><?php echo esc_html($subscription->get_receiver_name()); ?></span>,<br><span class="augmented-card-text-medium"><?php echo esc_html($subscription->get_sender_name()); ?></span> sent you an Augmented Card!
  </div>
  <div class="augmented-card-divider"></div>
  <h3 class="augmented-card-headline">Instructions</h3>
  <div>To see the card, please click on the following link from your phone:</div>
  <div class="augmented-card-url">
    <a href="<?php echo esc_url($subscription->get_card_url()); ?>"><?php echo esc_url($subscription->get_card_url()); ?></a>
  </div>
  <div class="augmented-card-divider-small"></div>
  <div>If you are viewing this email on desktop,<br>use your phone camera to scan this QR Code:</div>
  <div class="augmented-card-qr">
    <img src="<?php echo $subscription->get_card_qr_code(); ?>" width="120" height="120" alt="QR Code">
  </div>
  <div class="augmented-card-divider"></div>
  <div class="augmented-card-footer">For more information, visit <a href="<?php echo site_url(); ?>">augmentedcards.com</a></div>
</div>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700');

    .augmented-card {
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

    .augmented-card img {
        max-width: 100%;
    }

    .augmented-card-divider {
        max-width: 488px;
        height: 1px;
        margin: 20px auto;
        background-color: #ff6347;
    }

    .augmented-card-divider-small {
        max-width: 376px;
        height: 1px;
        margin: 30px auto;
        background-color: #e4e4e4;
    }

    .augmented-card-headline {
        margin-top: 15px;
        margin-bottom: 5px;
        font-size: 16px;
        font-weight: bold;
        line-height: 24px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .augmented-card-text-medium {
        font-weight: 500;
    }

    .augmented-card-url {
        display: inline-block;
        margin-top: 5px;
        padding: 5px;
        background-color: #fafafc;
        border-radius: 2px;
    }

    .augmented-card-url a {
        color: #197eff;
        letter-spacing: 0.26px;
        line-height: 26px;
        text-decoration: underline;
    }

    .augmented-card-url a:hover {
        color: #0065e5;
    }

    .augmented-card-img {
        margin: 0 auto 20px auto;
        max-width: 165px;
    }

    .augmented-card-qr {
        max-width: 120px;
        margin: 15px auto 40px auto;
    }

    .augmented-card-footer {
        color: #898989;
        font-size: 12px;
    }

    .augmented-card-footer a {
        color: #898989;
        font-size: 12px;
    }

    .augmented-card-footer a:hover {
        color: #707070;
    }

    @media (max-width: 480px) {
        .augmented-card {
            padding: 25px;
        }
    }
</style>
