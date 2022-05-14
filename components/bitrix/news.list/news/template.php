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
$i = 1;

?>
<div class="news">
<form class="news__datepicker datepicker">
	<div class="datepicker__input input --date --start" data-minus-year="">
		<div class="input__wrap">
			<input class="input__area" type="text" name="date_start" placeholder="с 20.01.22" readonly="">
		</div>
	</div>
	<div class="datepicker__input input --date --end">
		<div class="input__wrap">
			<input class="input__area" type="text" name="date_end" placeholder="с 20.01.22" readonly="">
		</div>
	</div>
	<button class="datepicker__btn btn --purple --sq"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-datepicker__btn.php"
					)
				);?></button>
</form>
<div class="news__list row">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<a class="news__item n-item an fadeIn<? if ($i == 1 || $i == 2) echo ' --w2 --lg'; ?>" href="<?=$arItem["DETAIL_PAGE_URL"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="n-item__img">
			<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
		</div>
		<div class="n-item__date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
		<div class="n-item__name"><?= $arItem["NAME"]?></div>
	</a>
	<pre><? // print_r($arItem); ?></pre>
	<? $i++; ?>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
