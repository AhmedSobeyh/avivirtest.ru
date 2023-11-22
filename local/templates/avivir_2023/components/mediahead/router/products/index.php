<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
\CModule::IncludeModule("mediahead.helpers");
?>
<div class="content-block-ContentBlock-module-block">
	<div class="content-block-ContentBlock-module-info">
		<? $APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"breadcrumb",
			array(
				"COMPONENT_TEMPLATE" => "breadcrumb",
				"START_FROM" => "0",
				"PATH" => "",
				"SITE_ID" => "s1"
			),
			false
		); ?>
		<h2 class="content-block-ContentBlock-module-title content-block-ContentBlock-module-title-big">
			<?= GetMessage("MD_PRODUCTS") ?>
		</h2>
		<p class="content-block-ContentBlock-module-text content-block-ContentBlock-module-text-big content-block-ContentBlock-module-last">
			«Авивир» стремится предоставить профессионалам в сфере здравоохранения продукцию от производителей, лидирующих в своих сегментах. Мы работаем в следующих направлениях:
		</p>
		<div class="content-block-ContentBlock-module-bottom"></div>
	</div>
	<div class="content-block-ContentBlock-module-image">
		<img class="products-Products-module-banner" src="/upload/images/static_media/products/banner.png" alt="<?= GetMessage("MD_PRODUCTS") ?>" />
	</div>
</div>



<div class="content-block-ContentBlock-module-block products-Products-module-examples-wrapper">
	<div class="content-block-ContentBlock-module-info">
		<div class="content-block-ContentBlock-module-content products-Products-module-examples-content content-block-ContentBlock-module-last">
			<a class="products-Products-module-example" href="/products/covid-19/">
				<div class="products-Products-module-example-icon">
					<svg width="64" height="138" viewBox="0 0 64 138" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.156 26.457h1.045V20.83h-1.045v5.627zm5.774-4.293v.571c-.353-.426-.884-.619-1.487-.619-1.23 0-2.17.82-2.17 2.066s.94 2.082 2.17 2.082c.58 0 1.086-.185 1.44-.57v.224c0 .869-.419 1.303-1.367 1.303-.595 0-1.206-.201-1.584-.515l-.45.756c.49.402 1.286.61 2.09.61 1.503 0 2.315-.707 2.315-2.266v-3.642h-.957zm-1.334 3.248c-.764 0-1.31-.498-1.31-1.23 0-.723.546-1.214 1.31-1.214.756 0 1.302.49 1.302 1.214 0 .732-.546 1.23-1.302 1.23zm7.551-.08c-.362.209-.755.289-1.157.289-1.19 0-2.034-.836-2.034-1.977 0-1.166.844-1.978 2.042-1.978.603 0 1.109.2 1.551.643l.66-.643c-.531-.603-1.32-.916-2.26-.916-1.76 0-3.046 1.213-3.046 2.893 0 1.68 1.286 2.894 3.03 2.894.796 0 1.616-.24 2.203-.715v-2.243h-.989v1.753zm1.37 1.929h.9l2.654-7.573h-.9l-2.654 7.573zm3.98-.804h1.045V20.83h-1.045v5.627zm5.775-4.293v.571c-.354-.426-.884-.619-1.487-.619-1.23 0-2.17.82-2.17 2.066s.94 2.082 2.17 2.082c.579 0 1.085-.185 1.439-.57v.224c0 .869-.418 1.303-1.367 1.303-.595 0-1.206-.201-1.584-.515l-.45.756c.49.402 1.286.61 2.09.61 1.504 0 2.316-.707 2.316-2.266v-3.642h-.957zm-1.334 3.248c-.764 0-1.31-.498-1.31-1.23 0-.723.546-1.214 1.31-1.214.755 0 1.302.49 1.302 1.214 0 .732-.547 1.23-1.303 1.23zm9.866 1.045l-.008-5.627h-.86l-2.195 3.73-2.235-3.73h-.86v5.627h.997v-3.682l1.849 3.039h.466l1.849-3.087.008 3.73h.989z" fill="currentColor"></path>
						<path d="M12.018 51.34c.925 0 1.713-.33 2.235-.94l-.675-.643c-.41.45-.916.667-1.503.667-1.166 0-2.01-.82-2.01-1.978 0-1.157.844-1.977 2.01-1.977.587 0 1.093.217 1.503.659l.675-.635c-.522-.611-1.31-.94-2.227-.94-1.728 0-3.014 1.213-3.014 2.893 0 1.68 1.286 2.894 3.006 2.894zM13.256 65.813c-.361.209-.755.289-1.157.289-1.19 0-2.034-.836-2.034-1.978 0-1.165.844-1.977 2.042-1.977.603 0 1.11.2 1.551.643l.66-.643c-.531-.603-1.319-.916-2.26-.916-1.76 0-3.046 1.213-3.046 2.893 0 1.68 1.286 2.894 3.03 2.894.796 0 1.616-.24 2.203-.715V64.06h-.989v1.753zM15.572 82.617l-.008-5.627h-.86l-2.195 3.73-2.235-3.73h-.86v5.627h.997v-3.682l1.849 3.039h.466l1.849-3.087.008 3.73h.989zM50.059 115.469c1.543 0 2.275-.772 2.275-1.672 0-2.066-3.337-1.286-3.337-2.484 0-.426.354-.764 1.222-.764.49 0 1.045.145 1.552.443l.33-.812c-.49-.322-1.198-.499-1.873-.499-1.544 0-2.267.772-2.267 1.68 0 2.09 3.344 1.295 3.344 2.508 0 .418-.37.732-1.246.732-.692 0-1.407-.257-1.857-.619l-.362.812c.466.402 1.342.675 2.219.675z" fill="#5B818C"></path>
						<rect x="0.5" y="0.5" width="62.691" height="136.277" rx="19.906" stroke="#5B818C"></rect>
						<rect x="20.518" y="43.26" width="22.655" height="42.263" rx="6.577" fill="#5B818C"></rect>
						<rect x="22.366" y="99.939" width="19.731" height="26.487" rx="9.866" stroke="#5B818C" stroke-width="1.462"></rect>
						<path d="M24.943 110.321a7.323 7.323 0 017.324-7.323 7.323 7.323 0 017.323 7.323v6.142a7.323 7.323 0 01-14.647 0v-6.142z" fill="#E0EFE9"></path>
						<path d="M20.518 50.076h22.654M20.518 79.388h22.654" stroke="#E0EFE9" stroke-width="1.462"></path>
					</svg>
				</div>
				<p>Диагностические тесты</p>
				<svg width="130" height="134" viewBox="0 0 130 134" fill="none" xmlns="http://www.w3.org/2000/svg" class="products-Products-module-example-back">
					<path d="M6.864 133l10.554-18.187m0 0h33.423m-33.423 0L6.864 96.627 1 86.067l5.864-9.974 10.554-18.186h33.423m0 56.906L61.395 133m-10.554-18.187l10.554-18.186 5.864-10.56m-16.418-28.16l10.554 18.186 5.864 9.974m-16.418-28.16h33.423L94.818 39.72l5.864-10.56M50.841 57.907L40.286 39.72l-5.863-10.56 5.863-9.973L50.841 1h33.423l10.554 18.187 5.864 9.973M67.259 86.067l-10.554 18.186-5.864 9.974 5.864 10.56m10.554-38.72h33.423m0-56.907l10.554 18.187 5.864 9.973m-16.418-28.16l5.863-9.973L117.1 1H130m-29.318 85.067l10.554 18.186 5.864 9.974m-16.418-28.16l10.554-18.187 5.864-10.56m-9.968 75.093l9.968-18.186m0 0H130M117.1 57.32H130" stroke="#2E6366"></path>
				</svg>
			</a>
			<a class="products-Products-module-example" href="/products/medical-equipment/">
				<div class="products-Products-module-example-icon">
					<svg width="91" height="127" viewBox="0 0 91 127" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M26.166 48.374l20.858-35.396c.336-.57 1.07-.76 1.64-.424l18.701 11.001 1.977 1.163c.57.335.76 1.07.425 1.64l-8.071 13.697c9.95.333 28.748 6.379 28.748 28.416 0 21.024-13.462 29.932-23.413 30.996l4.348 11.481h13.518c.662 0 1.198.537 1.198 1.198v12.656c0 .661-.536 1.197-1.198 1.197H2.005a1.198 1.198 0 01-1.198-1.197v-12.656c0-.661.536-1.198 1.198-1.198h69.374l-4.348-11.48c9.951-1.065 23.412-9.973 23.412-30.997 0-22.037-18.798-28.083-28.747-28.416l-.584.99-12.204 20.71c-.336.57-1.07.76-1.64.424l-1.978-1.164-6.94 11.777c-.335.57-1.07.76-1.639.424l-14.007-8.24a1.198 1.198 0 01-.424-1.641l6.956-11.764-2.646-1.556a1.198 1.198 0 01-.424-1.64z" fill="none"></path>
						<path d="M29.236 51.571L22.28 63.335a1.198 1.198 0 00.424 1.642l14.007 8.24c.57.335 1.304.145 1.64-.425l6.94-11.777m5.686-47.101l3.504-5.927m12.884 15.568l3.505-5.927m-9.758 23.417l8.655-14.686a1.198 1.198 0 00-.425-1.641L48.663 12.554a1.198 1.198 0 00-1.64.424L26.166 48.374a1.198 1.198 0 00.425 1.641L47.27 62.18c.57.335 1.303.145 1.64-.424l12.203-20.71zm0 0v48.832m3.912 9.7c.648 0 1.32-.036 2.007-.11m-5.919-59.425c9.777.111 29.331 5.953 29.331 28.43 0 21.023-13.46 29.931-23.412 30.995m0 0l4.348 11.481m0 0H2.005c-.662 0-1.198.537-1.198 1.198v12.656c0 .661.536 1.197 1.198 1.197h82.892c.662 0 1.198-.536 1.198-1.197v-12.656c0-.661-.536-1.198-1.198-1.198H71.38zm-29.433-11.48l-4.348 11.48" stroke="#5B818C"></path>
						<path d="M54.481 7.988L52.53 6.839a1.797 1.797 0 01-.636-2.463l1.676-2.833A1.797 1.797 0 0156.026.91l1.96 1.153 16.389 9.64 1.297.763a1.797 1.797 0 01.636 2.463l-1.675 2.834a1.797 1.797 0 01-2.458.634l-1.305-.768-16.389-9.64z" fill="#5B818C"></path>
						<rect x="17.531" y="89.209" width="50.839" height="11.372" rx="1.797" fill="#E0EFE9"></rect>
						<path d="M17.531 95.229h50.84" stroke="#E0EFE9" stroke-width="1.198"></path>
						<circle cx="62" cy="43" r="10" fill="#5B818C"></circle>
						<circle cx="62" cy="43" r="4" fill="#E0EFE9"></circle>
					</svg>
				</div>
				<p>Медицинское оборудование</p>
				<svg width="130" height="134" viewBox="0 0 130 134" fill="none" xmlns="http://www.w3.org/2000/svg" class="products-Products-module-example-back">
					<path d="M6.864 133l10.554-18.187m0 0h33.423m-33.423 0L6.864 96.627 1 86.067l5.864-9.974 10.554-18.186h33.423m0 56.906L61.395 133m-10.554-18.187l10.554-18.186 5.864-10.56m-16.418-28.16l10.554 18.186 5.864 9.974m-16.418-28.16h33.423L94.818 39.72l5.864-10.56M50.841 57.907L40.286 39.72l-5.863-10.56 5.863-9.973L50.841 1h33.423l10.554 18.187 5.864 9.973M67.259 86.067l-10.554 18.186-5.864 9.974 5.864 10.56m10.554-38.72h33.423m0-56.907l10.554 18.187 5.864 9.973m-16.418-28.16l5.863-9.973L117.1 1H130m-29.318 85.067l10.554 18.186 5.864 9.974m-16.418-28.16l10.554-18.187 5.864-10.56m-9.968 75.093l9.968-18.186m0 0H130M117.1 57.32H130" stroke="#2E6366"></path>
				</svg>
			</a>
			<a class="products-Products-module-example" href="/products/prp-terapiya/">
				<div class="products-Products-module-example-icon">
					<svg width="31" height="119" viewBox="0 0 31 119" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M26.918 76.09H3.635v32.144c0 3.255 2.45 9.766 12.254 9.766 7.843 0 10.62-5.425 11.03-8.138V76.089z" fill="#E0EFE9"></path>
						<path d="M26.918 27.776c-9.098 1.275-14.178 1.188-23.283 0v43.855c9.182 1.302 14.168 1.275 23.283 0V27.776z" fill="#5B818C" stroke="#5B818C"></path>
						<path id="tube" d="M26.918 70.269c-9.098 1.281-14.178 1.194-23.283 0v6.595c9.182 1.31 14.168 1.282 23.283 0v-6.595z" fill="currentColor"></path>
						<path d="M3.594 7.568v100.579c0 3.285 2.378 9.853 11.888 9.853s11.614-6.568 11.478-9.853V7.568m-23.366 0c-1.23 0-2.87-.656-2.87-3.284C.725 1.657 2.365 1 3.595 1H26.96c1.23 0 2.87.657 2.87 3.284 0 2.628-1.64 3.284-2.87 3.284m-23.366 0H26.96" stroke="#5B818C"></path>
					</svg>
				</div>
				<p>PRP-терапия</p>
				<svg width="130" height="134" viewBox="0 0 130 134" fill="none" xmlns="http://www.w3.org/2000/svg" class="products-Products-module-example-back">
					<path d="M6.864 133l10.554-18.187m0 0h33.423m-33.423 0L6.864 96.627 1 86.067l5.864-9.974 10.554-18.186h33.423m0 56.906L61.395 133m-10.554-18.187l10.554-18.186 5.864-10.56m-16.418-28.16l10.554 18.186 5.864 9.974m-16.418-28.16h33.423L94.818 39.72l5.864-10.56M50.841 57.907L40.286 39.72l-5.863-10.56 5.863-9.973L50.841 1h33.423l10.554 18.187 5.864 9.973M67.259 86.067l-10.554 18.186-5.864 9.974 5.864 10.56m10.554-38.72h33.423m0-56.907l10.554 18.187 5.864 9.973m-16.418-28.16l5.863-9.973L117.1 1H130m-29.318 85.067l10.554 18.186 5.864 9.974m-16.418-28.16l10.554-18.187 5.864-10.56m-9.968 75.093l9.968-18.186m0 0H130M117.1 57.32H130" stroke="#2E6366"></path>
				</svg>
			</a>
			<a class="products-Products-module-example">
				<div class="products-Products-module-example-icon">
					<svg width="82" height="110" viewBox="0 0 82 110" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="8.03" y="0.696" width="45.919" height="19.306" rx="3.444" fill="#5B818C" stroke="#5B818C" stroke-width="1.392"></rect>
						<path d="M13.246 4.14v13.01M22.117 4.14v13.01M30.99 4.14v13.01M39.86 4.14v13.01M48.732 4.14v13.01" stroke="#E0EFE9" stroke-width="1.183" stroke-linecap="round"></path>
						<path d="M1.42 43.172V75.7h59.14V43.172H1.42z" stroke="#5B818C"></path>
						<path d="M48.732 20.108v4.14a4.14 4.14 0 004.14 4.14h3.548a4.14 4.14 0 014.14 4.139v45.301a4.14 4.14 0 01-1.213 2.927l-20.935 20.936a4.14 4.14 0 01-2.927 1.212H5.56a4.14 4.14 0 01-4.14-4.14V32.527a4.14 4.14 0 014.14-4.14h3.548a4.14 4.14 0 004.14-4.14v-4.14" stroke="#5B818C"></path>
						<path d="M28.33 70.77v-8.575h-8.576V56.48h8.575v-8.576h5.717v8.576h8.575v5.716h-8.575v8.576h-5.717z" fill="#E0EFE9"></path>
						<mask id="prefix__a" fill="#fff">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M72.963 91.403l-3.358 3.36a.592.592 0 01-.419.172H62.61a.591.591 0 01-.418-.172l-5.498-5.488a.591.591 0 010-.837l6.652-6.653a6.801 6.801 0 119.618 9.618zm-18.362-.038a.591.591 0 00-.836 0l-2.56 2.56a.591.591 0 00.418 1.01h5.126c.527 0 .79-.637.418-1.01l-2.566-2.56z">
							</path>
						</mask>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M72.963 91.403l-3.358 3.36a.592.592 0 01-.419.172H62.61a.591.591 0 01-.418-.172l-5.498-5.488a.591.591 0 010-.837l6.652-6.653a6.801 6.801 0 119.618 9.618zm-18.362-.038a.591.591 0 00-.836 0l-2.56 2.56a.591.591 0 00.418 1.01h5.126c.527 0 .79-.637.418-1.01l-2.566-2.56z" fill="#5B818C"></path>
						<path d="M72.963 91.403l.837.837-.837-.837zm-9.618-9.618l-.836-.836.836.836zm9.618 0l.837-.836-.837.836zm-15.796 12.14l.835-.837-.835.838zm-3.402-2.56l-.836-.836.836.837zm.836 0l.836-.837-.836.837zm2.091-2.927l-.836-.836.836.836zm5.5 6.325l.835-.838-.836.838zm7.413 0l-.837-.837.837.836zm.836.836l3.359-3.36-1.673-1.672-3.359 3.359 1.673 1.673zm-7.832.52h6.577v-2.366H62.61v2.365zm-6.752-6.007l5.499 5.488 1.671-1.674-5.499-5.488-1.67 1.674zm6.652-9.163l-6.653 6.653 1.673 1.673 6.653-6.653-1.673-1.673zm11.29 0a7.984 7.984 0 00-11.29 0l1.673 1.673a5.618 5.618 0 017.945 0l1.673-1.673zm0 11.29a7.984 7.984 0 000-11.29l-1.672 1.673a5.618 5.618 0 010 7.945L73.8 92.24zm-20.87-1.71l-2.56 2.56 1.672 1.673 2.56-2.56-1.672-1.673zm-1.306 5.59h5.126v-2.366h-5.126v2.365zm6.38-3.03l-2.566-2.561-1.671 1.674 2.565 2.56 1.671-1.674zm-1.254 3.03c1.581 0 2.372-1.913 1.253-3.03l-1.67 1.674a.591.591 0 01.417-1.01v2.365zM54.6 92.201a.591.591 0 01-.835 0l1.67-1.674a1.774 1.774 0 00-2.507.001l1.672 1.673zm2.927-3.764a.591.591 0 010 .837l-1.672-1.673a1.774 1.774 0 00.001 2.51l1.671-1.674zm-7.16 4.652c-1.117 1.117-.326 3.028 1.255 3.028v-2.365c.527 0 .79.637.418 1.01l-1.673-1.673zm12.241.663c.157 0 .307.062.418.172L61.356 95.6c.333.332.783.518 1.253.518v-2.365zm6.16.173a.591.591 0 01.417-.173v2.365c.471 0 .922-.187 1.255-.52l-1.673-1.672z" fill="#5B818C" mask="url(#prefix__a)"></path>
						<mask id="prefix__b" fill="#fff">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M51.393 96.398a6.801 6.801 0 100 13.602h10.055a.591.591 0 00.591-.591v-12.42a.591.591 0 00-.591-.591H51.393zm14.195 0a.591.591 0 00-.592.591v12.42c0 .326.265.591.592.591h8.87a6.801 6.801 0 000-13.602h-8.87z">
							</path>
						</mask>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M51.393 96.398a6.801 6.801 0 100 13.602h10.055a.591.591 0 00.591-.591v-12.42a.591.591 0 00-.591-.591H51.393zm14.195 0a.591.591 0 00-.592.591v12.42c0 .326.265.591.592.591h8.87a6.801 6.801 0 000-13.602h-8.87z" fill="#E0EFE9"></path>
						<path d="M45.775 103.199a5.618 5.618 0 015.618-5.618v-2.366a7.984 7.984 0 00-7.984 7.984h2.366zm5.618 5.618a5.618 5.618 0 01-5.618-5.618h-2.366a7.984 7.984 0 007.984 7.984v-2.366zm10.055 0H51.393v2.366h10.055v-2.366zm1.774.592v-12.42h-2.366v12.42h2.366zm-11.83-11.828h10.056v-2.366H51.393v2.366zm12.421-.592v12.42h2.366v-12.42h-2.366zm10.644 11.828h-8.87v2.366h8.87v-2.366zm5.619-5.618a5.618 5.618 0 01-5.619 5.618v2.366a7.984 7.984 0 007.984-7.984h-2.365zm-5.619-5.618a5.618 5.618 0 015.619 5.618h2.365a7.984 7.984 0 00-7.984-7.984v2.366zm-8.87 0h8.87v-2.366h-8.87v2.366zm-1.774 11.828c0 .98.795 1.774 1.775 1.774v-2.366c.326 0 .59.265.59.592h-2.365zm2.366-12.42a.591.591 0 01-.591.592v-2.366c-.98 0-1.775.794-1.775 1.774h2.366zm-2.957 0c0-.98-.794-1.774-1.774-1.774v2.366a.591.591 0 01-.592-.592h2.366zm-1.774 14.194c.98 0 1.774-.794 1.774-1.774h-2.366c0-.327.265-.592.592-.592v2.366z" fill="#5B818C" mask="url(#prefix__b)"></path>
					</svg>
				</div>
				<p>Лекарственные препараты</p>
				<svg width="130" height="134" viewBox="0 0 130 134" fill="none" xmlns="http://www.w3.org/2000/svg" class="products-Products-module-example-back">
					<path d="M6.864 133l10.554-18.187m0 0h33.423m-33.423 0L6.864 96.627 1 86.067l5.864-9.974 10.554-18.186h33.423m0 56.906L61.395 133m-10.554-18.187l10.554-18.186 5.864-10.56m-16.418-28.16l10.554 18.186 5.864 9.974m-16.418-28.16h33.423L94.818 39.72l5.864-10.56M50.841 57.907L40.286 39.72l-5.863-10.56 5.863-9.973L50.841 1h33.423l10.554 18.187 5.864 9.973M67.259 86.067l-10.554 18.186-5.864 9.974 5.864 10.56m10.554-38.72h33.423m0-56.907l10.554 18.187 5.864 9.973m-16.418-28.16l5.863-9.973L117.1 1H130m-29.318 85.067l10.554 18.186 5.864 9.974m-16.418-28.16l10.554-18.187 5.864-10.56m-9.968 75.093l9.968-18.186m0 0H130M117.1 57.32H130" stroke="#2E6366"></path>
				</svg>
			</a>
			<a href="/services/parapharmaceuticals/" class="products-Products-module-example">
				<div class="products-Products-module-example-icon">
					<svg width="98" height="131" viewBox="0 0 98 131" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M47.171 25.985l-21.91 12.65-8.283-14.347c-3.494-6.05-1.42-13.787 4.63-17.28 6.05-3.493 13.787-1.42 17.28 4.63l8.283 14.347zM27.622 43.24l21.91-12.65 8.283 14.348c3.494 6.05 1.42 13.787-4.63 17.28-6.05 3.493-13.787 1.42-17.28-4.63L27.622 43.24zM70.65 94.677l-17.889-17.89 15.426-15.426c4.94-4.94 12.95-4.94 17.89 0 4.94 4.94 4.94 12.95 0 17.89L70.65 94.677z" stroke="#5B818C"></path>
						<path d="M25.847 94.677l17.89-17.89-15.426-15.426c-4.94-4.94-12.95-4.94-17.89 0-4.94 4.94-4.94 12.95 0 17.89l15.426 15.426z" fill="#5B818C" stroke="#5B818C"></path>
						<mask id="prefix__a" fill="#fff">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M58.988 35.77h25.074c7.262 0 13.15-5.888 13.15-13.15 0-7.263-5.888-13.15-13.15-13.15H43.804l15.184 26.3z">
							</path>
						</mask>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M58.988 35.77h25.074c7.262 0 13.15-5.888 13.15-13.15 0-7.263-5.888-13.15-13.15-13.15H43.804l15.184 26.3z" fill="#5B818C"></path>
						<path d="M58.988 35.77l-.866.5.289.5h.577v-1zM43.804 9.47v-1h-1.732l.866 1.5.866-.5zm40.258 25.3H58.988v2h25.074v-2zm12.15-12.15c0 6.71-5.44 12.15-12.15 12.15v2c7.815 0 14.15-6.336 14.15-14.15h-2zm-12.15-12.15c6.71 0 12.15 5.439 12.15 12.15h2c0-7.816-6.335-14.15-14.15-14.15v2zm-40.258 0h40.258v-2H43.804v2zm-.866-.5l15.184 26.3 1.732-1L44.67 8.97l-1.732 1z" fill="#5B818C" mask="url(#prefix__a)"></path>
						<path d="M80.023 14.954h5.185a4.91 4.91 0 014.91 4.909v3.689M70.305 67.7l3.666-3.666a4.91 4.91 0 016.942 0l2.61 2.609M24.508 24.256l-2.592-4.49a4.91 4.91 0 011.796-6.706l3.195-1.844" stroke="#E0EFE9" stroke-linecap="round"></path>
						<circle cx="44.385" cy="91.992" r="1.992" fill="#E0EFE9"></circle>
						<circle cx="52.352" cy="94.384" r="1.992" fill="#E0EFE9"></circle>
						<circle cx="49.166" cy="105.541" r="1.992" fill="#E0EFE9"></circle>
						<circle cx="41.992" cy="101.557" r="1.992" fill="#E0EFE9"></circle>
						<circle cx="41.992" cy="120.684" r="1.992" fill="#E0EFE9"></circle>
						<circle cx="52.352" cy="114.308" r="1.992" fill="#E0EFE9"></circle>
						<circle cx="53.947" cy="128.654" r="1.992" fill="#E0EFE9"></circle>
					</svg>
				</div>
				<p>Парафармацевтика</p>
				<svg width="130" height="134" viewBox="0 0 130 134" fill="none" xmlns="http://www.w3.org/2000/svg" class="products-Products-module-example-back">
					<path d="M6.864 133l10.554-18.187m0 0h33.423m-33.423 0L6.864 96.627 1 86.067l5.864-9.974 10.554-18.186h33.423m0 56.906L61.395 133m-10.554-18.187l10.554-18.186 5.864-10.56m-16.418-28.16l10.554 18.186 5.864 9.974m-16.418-28.16h33.423L94.818 39.72l5.864-10.56M50.841 57.907L40.286 39.72l-5.863-10.56 5.863-9.973L50.841 1h33.423l10.554 18.187 5.864 9.973M67.259 86.067l-10.554 18.186-5.864 9.974 5.864 10.56m10.554-38.72h33.423m0-56.907l10.554 18.187 5.864 9.973m-16.418-28.16l5.863-9.973L117.1 1H130m-29.318 85.067l10.554 18.186 5.864 9.974m-16.418-28.16l10.554-18.187 5.864-10.56m-9.968 75.093l9.968-18.186m0 0H130M117.1 57.32H130" stroke="#2E6366"></path>
				</svg>
			</a>

		</div>
		<div class="content-block-ContentBlock-module-bottom"></div>
	</div>
</div>


<?
//apre($arResult);
// Тут будет mixed.list (разделы + элементы) - пока не написал
$APPLICATION->IncludeComponent(
	"mediahead:mixed.list",
	"products",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

		"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
		"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["sections"],

		"PROPERTY_CODE" => [0 => "EN_NAME"],
	),
	$component
);
?>