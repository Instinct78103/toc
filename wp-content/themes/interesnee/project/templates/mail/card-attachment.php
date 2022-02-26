<?php
/**
 * @var Ct\Data\Subscription $subscription
 */
?>
<div class="augmented-card-attachment">
  <div class="augmented-card-attachment-img">
    <img src="<?php echo ct_image_to_base64('logo.png'); ?>" alt="Augmented Card">
  </div>
  <div class="augmented-card-attachment-divider"></div>
  <div>Dear <span class="augmented-card-attachment-text-medium"><?php echo esc_html($subscription->get_receiver_name()); ?></span>,<br><span class="augmented-card-attachment-text-medium"><?php echo esc_html($subscription->get_sender_name()); ?></span> sent you an Augmented Card!</div>
  <div class="augmented-card-attachment-divider"></div>
  <div class="augmented-card-attachment-headline">Instructions</div>
  <div>To see the card, please use your phone camera to scan this QR code</div>
  <div class="augmented-card-attachment-qr">
    <img src="<?php echo $subscription->get_card_qr_code(); ?>" alt="QR Code">
  </div>
</div>
<style type="text/css">
    .augmented-card-attachment {
        padding: 25px;
        margin: 0 auto;
        border: 2px solid #ff6347;
        color: #3a3a3a;
        font-family: Ubuntu, serif;
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 0;
        line-height: 24px;
        text-align: center;
    }

    .augmented-card-attachment img {
        max-width: 100%;
    }

    .augmented-card-attachment-divider {
        max-width: 72px;
        height: 4px;
        margin: 15px auto;
        background-color: #ff6347;
    }

    .augmented-card-attachment-headline {
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .augmented-card-attachment-text-medium {
        font-weight: 500;
    }

    .augmented-card-attachment-img {
        margin: 0 auto 20px auto;
        max-width: 165px;
    }

    .augmented-card-attachment-qr {
        max-width: 110px;
        margin: 10px auto 15px auto;
    }
</style>
