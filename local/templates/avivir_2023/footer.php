<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
use Bitrix\Main\Config\Option;

$context = Context::getCurrent();

Loc::loadMessages(__FILE__);

?>

<? // START: App footer 
?>
</main>
<footer class="page-Footer-module-footer" id="footer">
	<div class="page-Footer-module-info">
		<a href="/"><svg width="47" height="42" viewBox="0 0 47 42" fill="none" xmlns="http://www.w3.org/2000/svg" class="page-Footer-module-logo">
				<g clip-path="url(#clip0_0_49)">
					<path d="M46.256 13.297H36.1799C36.022 13.297 35.8852 13.3976 35.8431 13.551L33.9226 19.8573C33.8542 20.0848 34.0226 20.3176 34.2593 20.3176H42.9096L37.3637 38.5223L29.7606 13.5457C29.7132 13.3976 29.5764 13.2917 29.4238 13.2917H23.1835C22.9467 13.2917 22.773 13.5245 22.8467 13.752L31.1812 41.1199C31.2339 41.2945 31.397 41.4162 31.5759 41.4162H37.9478C38.1319 41.4162 38.2898 41.2945 38.3424 41.1199L46.6506 13.8314C46.7296 13.5616 46.5349 13.2917 46.256 13.2917V13.297Z" fill="#DDF0E9"></path>
					<path d="M24.8249 27.6641L16.4904 0.296269C16.4378 0.121682 16.2747 0 16.0958 0H9.72385C9.53969 0 9.38184 0.121682 9.32922 0.296269L1.01574 27.5848C0.936812 27.8546 1.1315 28.1244 1.41037 28.1244H11.4918C11.6496 28.1244 11.7864 28.0239 11.8285 27.8705L13.7491 21.5642C13.8175 21.3367 13.6491 21.1039 13.4123 21.1039H4.75681L10.3026 2.89392L17.9058 27.8705C17.9531 28.0186 18.09 28.1244 18.2425 28.1244H24.4829C24.7197 28.1244 24.8933 27.8916 24.8197 27.6641H24.8249Z" fill="#DDF0E9"></path>
				</g>
				<defs>
					<clipPath id="clip0_0_49">
						<rect width="47" height="42" fill="white"></rect>
					</clipPath>
				</defs>
			</svg></a>
		<nav class="page-Footer-module-links">
			<ul>
				<li><a href="/products/">Продукция</a></li>
				<li><a href="/services/">Услуги</a></li>
				<li><a href="/business/company/">О компании</a></li>
				<li><a href="/media/">Медиа-центр</a></li>
				<li><a href="/contacts/">Контакты</a></li>
			</ul>
		</nav>
	</div>
	<div class="page-Footer-module-action">
		<a href="/contacts/"><button class="button-Button-module-button">Свяжитесь с нами</button></a>
		<p><a href="tel:+74957409920">+7 (495) 740-99-20</a></p>
		<p><a href="mailto:info@avivir.ru">info@avivir.ru</a></p>
		<p>
			121205, ул. Нобеля д. 5, офис 230,<br />
			Инновационный центр «Сколково»
		</p>
	</div>
	<div class="page-Footer-module-agreement">
		<span><a href="/privacy">Соглашение на обработку персональных данных</a> и
			<a href="/documents">Противодействие коррупции</a></span><a href="https://i.moscow/company/44003695"><img src="/upload/images/static_media/footer/moscow_cluster.png" alt="Московский инновационный кластер" /></a>
	</div>
</footer>
</div>
<? // END: App footer 
?>

<? // END: Application 
?>

<? // Yandex.Metrika counter 
?>
<script type="text/javascript">
	(function(m, e, t, r, i, k, a) {
		m[i] = m[i] || function() {
			(m[i].a = m[i].a || []).push(arguments)
		};
		m[i].l = 1 * new Date();
		k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
	})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym(89568510, "init", {
		clickmap: true,
		trackLinks: true,
		accurateTrackBounce: true,
		webvisor: true
	});
</script>
<noscript>
	<div><img src="https://mc.yandex.ru/watch/65192692" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<? // Yandex.Metrika counter 
?>

<!-- Google Tag Manager -->
<script>
	(function(w, d, s, l, i) {
		w[l] = w[l] || [];
		w[l].push({
			'gtm.start': new Date().getTime(),
			event: 'gtm.js'
		});
		var f = d.getElementsByTagName(s)[0],
			j = d.createElement(s),
			dl = l != 'dataLayer' ? '&l=' + l : '';
		j.async = true;
		j.src =
			'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
		f.parentNode.insertBefore(j, f);
	})(window, document, 'script', 'dataLayer', 'GTM-PWGP95R');
</script>
<!-- End Google Tag Manager -->


<? // calltouch 
?>
<script type="text/javascript">
	(function(w, d, n, c) {
		w.CalltouchDataObject = n;
		w[n] = function() {
			w[n]["callbacks"].push(arguments)
		};
		if (!w[n]["callbacks"]) {
			w[n]["callbacks"] = []
		}
		w[n]["loaded"] = false;
		if (typeof c !== "object") {
			c = [c]
		}
		w[n]["counters"] = c;
		for (var i = 0; i < c.length; i += 1) {
			p(c[i])
		}

		function p(cId) {
			var a = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				i = function() {
					a.parentNode.insertBefore(s, a)
				},
				m = typeof Array.prototype.find === 'function',
				n = m ? "init-min.js" : "init.js";
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mod.calltouch.ru/" + n + "?id=" + cId;
			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", i, false)
			} else {
				i()
			}
		}
	})(window, document, "ct", "fqw2ask5");
</script>
<? // calltouch 
?>
<!-- calltouch request-->
<script type="text/javascript">
	jQuery(document).on("submit", function() {
		var m = jQuery(this);
		var fio = m.find('input[name="name"]').val();
		var phone = m.find('input[name="phone"]').val();
		var mail = m.find('input[name="email"]').val();
		var comment = m.find('textarea[name="comment"]').val();
		var ct_site_id = '46685';
		var sub = 'Заявка c ' + location.hostname;
		var ct_data = {
			fio: fio,
			phoneNumber: phone,
			email: mail,
			comment: comment,
			subject: sub,
			requestUrl: location.href,
			sessionId: window.call_value
		};
		console.log(ct_data);
		if (!!mail && !!fio && !!phone) {
			jQuery.ajax({
				url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/' + ct_site_id + '/register/',
				dataType: 'json',
				type: 'POST',
				data: ct_data,
				async: false
			});
		}
	});
</script>
<!-- calltouch request-->
</body>

</html>