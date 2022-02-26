<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">

	<div class="footer-container">
		<div class="office-locations">
			<p class="div-heading">Наши контакты</p>
			<ul class="owl-carousel" data-settings='{"autorotate":true,"desktop":1,"tablet":1,"mobile":1,"screen_resolution_to_off":"768","speed":5000, "nav": false, "dots": false}'>
				<li>
					<p><span class="flag ru"></span>Екатеринбург</p>
					<a href="#" target="_blank">ул. Куйбышева 44Д, оф. 2002</a>
				</li>
				<li>
					<p><span class="flag ru"></span>Красноярск</p>
					<a href="#" target="_blank">ул. Красной армии, д. 10/5</a>
				</li>
				<li>
					<p><span class="flag ru"></span>Сочи</p>
					<a href="#" target="_blank">ул. Островского, 19, оф. 6</a>
				</li>
				<li>
					<p><span class="flag vn"></span>Vietnam</p>
					<a href="#" target="_blank">No.90 Nguyen Dinh Chieu Street, <br>9th floor, Dakao Ward, District 1, <br>Ho Chi Minh City</a>
				</li>
				<li>
					<p><span class="flag kz"></span>Казахстан, г. Рудный</p>
					<a href="#" target="_blank">ул. Горняков, 70, оф. 413</a>
				</li>
				<li>
					<p><span class="flag us"></span>USA, Newport Beach</p>
					<a href="#" target="_blank">20411 Birch St., Suite 330, Newport Beach,<br>Orange County, CA, 92660
					</a>
				</li>
				<li>
					<p><span class="flag us"></span>USA, New York</p>
					<a href="#" target="_blank">222 Broadway, New York,<br>
						NY. 10038, 19th Floor
					</a>
				</li>
				<li>
					<p><span class="flag us"></span>USA, Chicago</p>
					<a href="#" target="_blank">111 W Illinois St,<br>
						Chicago, IL, 60654
					</a>
				</li>
			</ul>
		</div>
		<div class="social-links">
			<p class="div-heading">Мы в социальных сетях</p>
			<ul>
				<li><a href="#" target="_blank"><svg width="20" height="20">
							<use xlink:href="/wp-content/themes/interesnee/project/assets/icons/sprite.svg#icon-instagram" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
						</svg></a></li>
				<li><a href="#" target="_blank"><svg width="20" height="20">
							<use xlink:href="/wp-content/themes/interesnee/project/assets/icons/sprite.svg#icon-vk" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
						</svg></a></li>
				<li><a href="#" target="_blank"><svg width="20" height="20">
							<use xlink:href="/wp-content/themes/interesnee/project/assets/icons/sprite.svg#icon-facebook" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
						</svg></a></li>
				<li><a href="#" target="_blank"><svg width="20" height="20">
							<use xlink:href="/wp-content/themes/interesnee/project/assets/icons/sprite.svg#icon-linked-in" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
						</svg></a></li>
			</ul>
		</div>
		<div class="bottom">
			<p class="copyright">© 2006-<?php echo date("Y"); ?> «Очень Интересно»</p>
			<p class="policy"><a href="https://www.interesnee.ru/static/docs/privacy_policy.pdf">Политика обработки персональных данных</a></p>
		</div>
	</div>

</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>