<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()

$strReturn .= '
	<nav class="c-breadcrumb c-breadcrumb--scrollable" aria-label="'.GetMessage('MD_BREADCRUMB_NAME').'">
		<ol class="c-breadcrumb__list" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
$p=explode('/',$arResult[$index]["LINK"]);

if (($arResult[$index]["LINK"] <> "" && $index != $itemSize-1) || ($p[1]=='media'))
	{
		$strReturn .= '
			<li
				class="c-breadcrumb__item"
				id="bx_breadcrumb_'.$index.'"
				itemprop="itemListElement"
				itemscope
				itemtype="http://schema.org/ListItem"
			>
				<a class="c-breadcrumb__link" href="'.$arResult[$index]["LINK"].'" itemprop="item">
					<span itemprop="name">
						'.$title.'
					</span>
				</a>
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';
	}
	else
	{
		$strReturn .= '
			<li
				class="c-breadcrumb__item is-active"
				id="bx_breadcrumb_'.$index.'"
				itemprop="itemListElement"
				itemscope
				itemtype="http://schema.org/ListItem"
			>
				'.$title.'
				<meta itemprop="name" content="'.$title.'">
				<link itemprop="item" href="'.$arResult[$index]["LINK"].'">
				<meta itemprop="position" content="'.($index + 1).'">
			</li>';
	}
}

$strReturn .= '
		</ol>
	</nav>
';

return $strReturn;
