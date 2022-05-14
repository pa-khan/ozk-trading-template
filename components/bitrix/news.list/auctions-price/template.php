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

use Bitrix\Main\Config\Option;

// Начальная цена
$auction_price = Option::get("grain.customsettings","auction_price");
// Начальная дата
$auction_date = Option::get("grain.customsettings","auction_date");
$summPrice = 0;
$initialVal = false;
?>
<?= $arParams['YEAR'] ?>
<?foreach($arResult["SECTIONS"] as $arSection):?>
	<?
	$currentDate = end($arSection["ELEMENTS"])["ACTIVE_FROM"];
	?>
<?endforeach;?>

<div class="result__elem">
	<div class="result__elem-title h3"><h3><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-result__elem-title-1.php"
					)
				);?></h3> <span>на <?= $currentDate; ?></span></div>
	<form class="result__elem-datepicker datepicker" id="auc-price-form">
		<div class="datepicker__input input --date --start">
			<div class="input__wrap">
				<input class="input__area" type="text" name="date_price_start" value="<?= isset($arParams["YEAR"]) ? $arParams["YEAR"] : null ?>" placeholder="Выбрать" readonly="" id="auc-price-input">
			</div>
		</div>
		<button class="datepicker__btn btn --purple --sq --w2" id="auc-price-button"><?$APPLICATION->IncludeComponent(
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
	<div class="result__elem-list" id="auc-price-list">
		<?foreach($arResult["SECTIONS"] as $arSection):?>
		<?
			$currentPrice = (int)end($arSection["ELEMENTS"])["DISPLAY_PROPERTIES"]["PRICE"]["~VALUE"];
			$prevPrice = (int)prev($arSection["ELEMENTS"])["DISPLAY_PROPERTIES"]["PRICE"]["~VALUE"];
		?>


		<?foreach($arSection["ELEMENTS"] as $arItem):?>

			<?
				$activeDate = end($arSection["ELEMENTS"])["ACTIVE_FROM"];
				// $summPrice +=  $arItem["DISPLAY_PROPERTIES"]["PRICE"]["~VALUE"] * $arItem["DISPLAY_PROPERTIES"]["VALUE"]["~VALUE"];
				$summPrice +=  (int)$arItem["DISPLAY_PROPERTIES"]["PRICE_SUMM"]["~VALUE"];
			?>
		<?endforeach;?>

		<? if ($arSection["ID"] == 49): ?>
		<div class="result__elem-item <? if($currentPrice != 0) echo '--arrow-show' ?>"  id="auc-price-zd-block">
			<div class="result__elem-icon">
				<img src="/upload/icons/rail.svg" alt="">
			</div>
			<div class="result__elem-info">
				<div class="result__elem-name"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-result-zd.php"
					)
				);?></div>
				<div class="result__elem-value <? if($currentPrice <= 18500 && $currentPrice != 0) { echo '--down'; } ?>">
<? // echo $arParams["YEAR"]; echo $activeDate; ?>
					<? if (isset($arParams["YEAR"]) && $arParams["YEAR"] != $activeDate) { ?>
					0
					<? } else { ?>
						<span><?= number_format($currentPrice, 0, '', ' ') ?></span> ₽
						<? if($currentPrice != 0) { echo '<img src="/upload/icons/arrow-up.svg" alt="">'; } ?>
					<? } ?>
				</div>
			</div>
		</div>
		<? endif; ?>

		<? if ($arSection["ID"] == 50): ?>
		<div class="result__elem-item <? if($currentPrice != 0) echo '--arrow-show' ?> --yellow" id="auc-price-auto-block">
			<div class="result__elem-icon">
				<img src="/upload/icons/auto.svg" alt="">
			</div>
			<div class="result__elem-info">
				<div class="result__elem-name"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-result-auto.php"
					)
				);?></div>
				<div class="result__elem-value <? if($currentPrice <= 17500 && $currentPrice != 0) { echo '--down'; } ?>">
					<? if (isset($arParams["YEAR"]) && $arParams["YEAR"] != $activeDate) { ?>
					0
					<? } else { ?>
					<span><?= number_format($currentPrice, 0, '', ' ') ?></span> ₽
					<? if($currentPrice != 0) { echo '<img src="/upload/icons/arrow-up-yellow.svg" alt="">'; } ?>

					<? } ?>
				</div>
			</div>
		</div>
		<? endif; ?>

		<?endforeach;?>
		<?
		$total = $summPrice + trim($auction_price); 
		$total = str_split($total);
		foreach ($total as &$el) {
			$el = '<span>'.$el.'</span>';
		}
		?>
		<div class="result__elem-item">
			<div class="result__elem-desc"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-result-all-r.php"
					)
				);?></div>
			<div class="result__elem-total" id="auc-price-total">
			<?= implode('', $total) ?>
			</div>
		</div>
	</div>
</div>
