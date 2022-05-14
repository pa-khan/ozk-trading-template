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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<div class="price">
	<div class="price__inner">
		<div class="price__info"></div>
	</div>
	<div class="price__areas">

	<?	$i = 1;
		foreach ($arResult['SECTIONS'] as &$arSection) {
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams); ?>
			<div class="price__area<? if($i == 1) echo ' --current'; ?>" style="left: <?= $arSection['UF_OFFSET_LEFT'] ?>px; bottom: <?= $arSection['UF_OFFSET_BOTTOM'] ?>px; clip-path: path('<?= $arSection['UF_CLIP_PATH'] ?>')">
				<div class="price__scheme"><?= $arSection['~UF_SVG'] ?></div>
				<div class="price__info">
					<div class="price__name"><?= $arSection['NAME'] ?></div>
					<div class="price__list">
						<?
						$items = GetIBlockElementList($arSection['IBLOCK_ID'], $arSection['ID']);
						while($arItem = $items->GetNext()) { ?>
							<a class="price__link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
						<? } ?>
					</div>
				</div>
			</div>
	<? $i++;
		}
	?>

	</div>
	<div class="price__map"><img src="/upload/map.svg" alt=""></div>
</div>