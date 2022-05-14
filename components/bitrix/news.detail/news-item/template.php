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
<div class="news-item">
	<a class="news-item__btn btn --purple" href="<?= SITE_DIR ?>press_center/"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-news-item__btn.php"
					)
				);?><img src="/upload/icons/arrow.svg" alt=""></a>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
	<div class="news-item__img">
		<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
	</div>
	<?endif?>
	<div class="news-item__date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></div>
	<div class="news-item__text">
		<h3><?=$arResult["NAME"]?></h3>
		<?echo $arResult["DETAIL_TEXT"];?>
	</div>
	<? if ($arResult["PROPERTIES"]["TAGS"]["VALUE"]) { ?>
	<div class="news-item__tags">
		<? foreach($arResult["PROPERTIES"]["TAGS"]["VALUE"] as $item) { ?>
		<div class="news-item__tag"><?= $item ?></div>
		<? } ?>
	</div>
	<? } ?>
	<div class="news-item__actions row">
		<div class="news-item__action --purple print-btn">
			<div class="news-item__icon">
				<img src="/upload/icons/print.svg" alt="">
			</div>
			<div class="news-item__desc"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-print-btn.php"
					)
				);?></div>
		</div>
		<div class="news-item__action share-btn">
			<div class="news-item__icon">
				<img src="/upload/icons/share.svg" alt="">
			</div>
			<div class="news-item__desc"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-share-btn.php"
					)
				);?></div>
			<div class="news-item__inner"><script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="transparent" data-options="small,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div></div>
		</div>
	</div>
</div>