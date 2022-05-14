<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<div class="price-item">
	<div class="price-item__info row">
		<a class="price-item__btn btn --purple --sq" data-fancybox="" data-src="#popup-sell" href="javascript:;"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-price-item__btn.php"
					)
				);?></a>
		<div class="price-item__desc"><?= $arResult["PREVIEW_TEXT"];?></div>
	</div>

	<div class="price-item__main">
		<div class="price-item__ps"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-price-item__ps.php"
					)
				);?></div>
		<div class="price-item__table p-table an fadeIn --loaded" data-timeout="0.2s"><?= ($arResult["PROPERTIES"]["PRICE_TABLE"]["~VALUE"]["TEXT"]); ?></div>
	</div>
</div>