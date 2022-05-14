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
<div class="docs-main">
	<div class="docs-main__list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<? $file = new SplFileInfo($arItem["DISPLAY_PROPERTIES"]["DOC"]["FILE_VALUE"]["SRC"]); $fileType = $file->getExtension(); ?>
		<a class="docs-main__item" href="<?= ($arItem["DISPLAY_PROPERTIES"]["DOC"]["FILE_VALUE"]["SRC"]) ?>" target="_blank" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="docs-main__info">
				<div class="docs-main__icon">
					<img src="/upload/<?= $fileType ?>.svg" alt="">
				</div>
				<div class="docs-main__name"><?= $arItem["NAME"]?></div>
			</div>
			<div class="docs-main__actions">
				<? $fileSize = $arItem["DISPLAY_PROPERTIES"]["DOC"]["FILE_VALUE"]["FILE_SIZE"] / 1024 / 1024; ?>
				<div class="docs-main__size"><?= round($fileSize, 2) ?> Mb</div>
				<div class="docs-main__download">
					<img src="/upload/icons/download.svg" alt="">
				</div>
			</div>
		</a>
	<?endforeach;?>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>
