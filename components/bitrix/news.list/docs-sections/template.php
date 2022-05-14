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
<div class="sections__docs">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<? $file = new SplFileInfo($arItem["DISPLAY_PROPERTIES"]["DOC"]["FILE_VALUE"]["SRC"]); $fileType = $file->getExtension(); ?>
	<a class="sections__docs-item" href="<?= ($arItem["DISPLAY_PROPERTIES"]["DOC"]["FILE_VALUE"]["SRC"]) ?>" target="_blank" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	  <div class="sections__docs-icon">
		<img src="/upload/<?= $fileType ?>.svg" alt="">
	  </div>
	  <div class="sections__docs-name"><?= $arItem["NAME"]?></div>
	</a>
<?endforeach;?>
</div>
