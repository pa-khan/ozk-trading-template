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
<div class="team row">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<? if ($i == 1) { ?>
	<div class="team__dir" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="team__dir-img">
			<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
		</div>
		<div class="team__dir-info">
			<div class="team__dir-name h3"><?= $arItem["NAME"]?></div>
			<div class="team__dir-duty"><?= $arItem["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"] ?></div>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<div class="team__dir-text"><?= $arItem["PREVIEW_TEXT"];?></div>
			<?endif;?>
		</div>
	</div>
	<? } else { ?>
	<div class="team__staff-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="team__staff-img">
			<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
		</div>
		<div class="team__staff-name"><?= $arItem["NAME"]?></div>
		<div class="team__staff-duty"><?= $arItem["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"] ?></div>
	</div>
	<? } ?>
	<? $i++; ?>
<?endforeach;?>
</div>
