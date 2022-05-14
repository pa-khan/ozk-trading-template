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
<div class="sections__offices offices">
<? foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="offices__item<? if ($i == 1) { echo " --current"; } ?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="top: <?= $arItem["PROPERTIES"]["OFFSET_TOP"]["~VALUE"] ?>px; margin-left: <?= $arItem["PROPERTIES"]["OFFSET_LEFT"]["~VALUE"] ?>px">
		<div class="offices__info">
			<div class="offices__info-city"><?= $arItem["NAME"]?></div>
			<div class="offices__info-address"><?= $arItem["PREVIEW_TEXT"];?></div>
		</div>
	</div>
	<? $i++ ?>
<?endforeach;?>
</div>
