<style>
	.c-timer {
		background-color: rgb(var(--theme-secondary));
		padding-bottom: 2.5rem;
		padding-top: 2.5rem;
		position: relative;
		z-index: 1;
	}
	.c-timer__bg-holder  {
		display: none;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	.c-timer__layout {
		display: grid;
		grid-template-columns: 100%;
		row-gap: 2.5rem;
	}

	.c-timer__title {
		color: rgb(var(--theme-primary));
		font-size: 1.5rem;
		font-weight: 700;
		line-height: 1.3334;
		margin-bottom: 1.25rem;
	}

	.c-timer__desc {
		color: rgb(var(--theme-on-secondary-darken-3));
		font-size: 1.5rem;
		font-weight: 500;
		line-height: 1.6667;
	}
	.c-timer__prices {
		display: flex;
		align-items: flex-end;
		color: rgb(var(--theme-on-secondary-darken-3));
	}
	.c-timer__bg-holder--start {
		background-image: url("data:image/svg+xml,%3Csvg width='236' height='395' viewBox='0 0 236 395' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg opacity='0.5' clip-path='url(%23clip0_334_773)'%3E%3Cpath d='M-86.6044 394.5L-144.894 293.539L-86.6044 192.578L29.9755 192.578L88.2654 293.539L29.9755 394.5L-86.6044 394.5Z' stroke='%2379ECC2'/%3E%3Cpath d='M-86.6044 192.729L-144.894 91.7683L-86.6044 -9.19287L29.9755 -9.19287L88.2654 91.7683L29.9755 192.729L-86.6044 192.729Z' stroke='%2379ECC2'/%3E%3Cpath d='M30.5528 192.729L-27.7371 91.7683L30.5528 -9.19287L147.133 -9.19287L205.423 91.7683L147.133 192.729L30.5528 192.729Z' stroke='%2379ECC2'/%3E%3Cline x1='-494.34' y1='91.1929' x2='203.396' y2='91.1929' stroke='%2379ECC2'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='clip0_334_773'%3E%3Crect width='395' height='304' fill='white' transform='translate(-68 395) rotate(-90)'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E%0A");
	}
	.c-timer__prices--large {
		margin-right: 4rem;
	}
	.c-timer__prices--large .c-timer__prices-title {
		font-size: 1.5rem;
		font-weight: 700;
		line-height: 1.3334;
	}

	.c-timer__prices--small .c-timer__prices-title {
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.3334;
	}

	.c-timer__prices-txt {
		font-size: 1.5rem;
		font-weight: 400;
		line-height: 1.3334;
	}
	.c-timer__block {
		background-color: #fff;
		border-radius: 1rem;
		box-shadow: 0px 0px 30px #5AD8A9;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: space-between;
		height: 100%;
		padding: 2rem 1.5rem;
		position: relative;
	}
	.c-timer__block-title {
		color: rgb(var(--theme-secondary));
		font-size: 1rem;
		font-weight: 700;
		line-height: 1.25;
	}
	.c-timer__layout--info,
	.c-timer__layout--prices {
		display: flex;
		flex-direction: column;
		row-gap: 1rem;
	}

	.c-timer__layout--prices {
		justify-content: space-evenly;
	}

	.c-timer-clock {
		display: flex;
		margin-top: 1.625rem;
		margin-bottom: 3rem;
	}

	.c-timer__box {
		display: flex;
		position: relative;
		justify-content: center;
	}
	.c-timer-item {
		display: flex;
		align-items: center;
		position: relative;
		font-size: 1rem;
		font-weight: 700;
		justify-content: center;
		width: 1.375rem;
		height: 2.187rem;
		border-radius: 4px;
		border: 1px solid black;
		text-align: center;
	}

	.c-timer__box:not(:last-child) {
		margin-right: 1rem;
	}

	.c-timer-item:not(:last-child) {
		margin-right: 0.3rem;
	}

	.c-timer__days {
		position: relative;
	}

	.c-timer__days:after,
	.c-timer__hours:after,
	.c-timer__minutes:after,
	.c-timer__seconds:after {
		font-size: 0.625rem;
		font-weight: 400;
		position: absolute;
		bottom: -20px;
	}

	.c-timer__days:after {
		content: 'дней';
	}

	.c-timer__hours:after {
		content: 'часов';
	}
	.c-timer__minutes:after {
		content: 'минут';
	}

	.c-timer__seconds:after {
		content: 'секунд';
	}

	@media (min-width: 48em) {
		.c-timer__layout {
			column-gap: 2.5rem;
			grid-template-columns: repeat(2, 1fr);
		}

		.c-timer__block {
			grid-column: span 2;
			width: 50%;
			justify-self: center;
		}
	}

	@media (min-width: 62em) {
		.c-timer__layout{
			column-gap: 5rem;
			grid-template-columns: repeat(2, 1fr);
			row-gap: 3.75rem;
		}

		.c-timer__title {
			font-size: 2.5rem;
			line-height: 1.2;
		}

		.c-timer__desc  {
			font-size: 2rem;
			line-height: 1.5;
		}
		.c-timer-item {
			width: 2.125rem;
			height: 3.575rem;
			font-size: 1.75rem;
		}
	}

	@media (min-width: 75em) {
		.c-timer  {
			padding-bottom: 5rem;
			padding-top: 5rem;
		}
		.c-timer__bg-holder {
			display: block;
		}
		.c-timer__layout{
			column-gap: 5rem;
			grid-template-columns: 18rem  26rem auto;
			row-gap: 3.75rem;
		}
		.c-timer__layout--prices {
			justify-content: space-between;
		}

		.c-timer__block {
			grid-column: unset;
			width: 100%;
		}

		.c-timer__prices--large .c-timer__prices-title {
			font-size: 3rem;
    		line-height: 1.1167;
		}

		.c-timer__prices--small .c-timer__prices-title {
			font-size: 2.25rem;
    		line-height: 1.4167;
		}
	}

</style>
<?// START: Timer ?>
<section class="c-timer t-dark">
	<div class="c-timer__bg-holder c-timer__bg-holder--start"></div>
	<div class="o-container@lg">
		<div class="c-timer__body">
			<div class="c-timer__layout">
				<div class="c-timer__layout--info">
					<h2 class="c-timer__title">Акция</h2>
					<? // START: Picture ?>
					<picture class="c-picture o-ratio o-ratio--4x3">
						<img
							class="c-picture__img c-picture__img--contain"
							src="/upload/images/timer/product-img.png"
							alt="Видео-инструкции тестов"
						>
					</picture>
					<? // END: Picture ?>
				</div>
				<div class="c-timer__layout--prices">
					<h3 class="c-timer__desc">Экспресс-тест RapiGEN BIOCREDIT COVID-19 IgG+IgM Duo</h3>
					<div class="c-timer__prices">
						<div class="c-timer__prices--large">
							<p class="c-timer__prices-title">125 ₽</p>
							<span class="c-timer__prices-txt">опт</span>
						</div>
						<div class="c-timer__prices--small">
							<p class="c-timer__prices-title">250 ₽</p>
							<span class="c-timer__prices-txt">розница</span>
						</div>
					</div>
				</div>
				<div class="c-timer__block">
					<span class="c-timer__block-title">До конца акции осталось</span>
					<div class="c-timer-clock">
						<div class="c-timer__days c-timer__box">
							<span class="c-timer-item">0</span>
							<span class="c-timer-item">0</span>
							<span class="c-timer-item">0</span>
						</div>
						<div class="c-timer__hours c-timer__box">
							<span class="c-timer-item">0</span>
							<span class="c-timer-item">0</span>
						</div>
						<div class="c-timer__minutes c-timer__box">
							<span class="c-timer-item">0</span>
							<span class="c-timer-item">0</span>
						</div>
						<div class="c-timer__seconds c-timer__box">
							<span class="c-timer-item">0</span>
							<span class="c-timer-item">0</span>
						</div>
					</div>

					<div class="c-timer__btn-group">
						<?// START: Button ?>
						<a
							class="
								c-btn
								c-btn--kind-primary
								c-btn--size-lg
								c-app-header__btn
							"
							href="/products/covid-19/rapigen-biocredit-covid-19-igg-igm-duo/"
						>
							<span class="c-btn__overlay"></span>
							<span class="c-btn__content">
								Купить
							</span>
						</a>
						<?// END: Button ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?// END: Timer ?>

<script>
	window.onload = function(e){
		var $clock = $('.c-timer-clock'),
			eventTime = moment('25-03-2022 23:59:59', 'DD-MM-YYYY HH:mm:ss').unix(),
			currentTime = moment().unix(),
			diffTime = eventTime - currentTime,
			duration = moment.duration(diffTime * 1000, 'milliseconds'),
			interval = 1000;

		if(diffTime > 0) {

			// $clock.show();
			$clock.empty();

			var $d = $('<div class="c-timer__days c-timer__box" ></div>').appendTo($clock),
				$h = $('<div class="c-timer__hours c-timer__box" ></div>').appendTo($clock),
				$m = $('<div class="c-timer__minutes c-timer__box" ></div>').appendTo($clock),
				$s = $('<div class="c-timer__seconds c-timer__box" ></div>').appendTo($clock);

			var $itemD = $('<span class="c-timer-item"></span>').appendTo($d),
				$itemDD = $('<span class="c-timer-item"></span>').appendTo($d),
				$itemDDD= $('<span class="c-timer-item"></span>').appendTo($d),
				$itemH = $('<span class="c-timer-item"></span>').appendTo($h),
				$itemHH = $('<span class="c-timer-item"></span>').appendTo($h),
				$itemM = $('<span class="c-timer-item"></span>').appendTo($m),
				$itemMM = $('<span class="c-timer-item"></span>').appendTo($m),
				$itemS = $('<span class="c-timer-item"></span>').appendTo($s);
				$itemSS = $('<span class="c-timer-item"></span>').appendTo($s);


			setInterval(function(){
				duration = moment.duration(duration.asMilliseconds() - interval, 'milliseconds');
				var d = moment.duration(duration).days(),
					h = moment.duration(duration).hours(),
					m = moment.duration(duration).minutes(),
					s = moment.duration(duration).seconds();


				d = $.trim(d).length === 1 ? '0' + d : '0' + d;
				h = $.trim(h).length === 1 ? '0' + h : h;
				m = $.trim(m).length === 1 ? '0' + m : m;
				s = $.trim(s).length === 1 ? '0' + s : s;

				let arrD = [...d.toString()].map(Number);
				let arrH = [...h.toString()].map(Number);
				let arrM = [...m.toString()].map(Number);
				let arrS = [...s.toString()].map(Number);

				$itemD.text(arrD[0]);
				$itemDD.text(arrD[1]);
				$itemDDD.text(arrD[2]);

				$itemH.text(arrH[0]);
				$itemHH.text(arrH[1]);

				$itemM.text(arrM[0]);
				$itemMM.text(arrM[1]);

				$itemS.text(arrS[0]);
				$itemSS.text(arrS[1]);


			}, interval);
		}
	};
</script>
