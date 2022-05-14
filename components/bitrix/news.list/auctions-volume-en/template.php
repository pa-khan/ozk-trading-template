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
						"PATH" => "/inc/t2-result__elem-title-2.php"
					)
				);?></h3></div>
	<form class="result__elem-datepicker datepicker" id="auc-volume-form">
		<div class="datepicker__input input --date --start">
			<div class="input__wrap">
				<input class="input__area" type="text" name="date_price_start" value="<?= $arParams["FROM"]; ?>" placeholder="From" readonly="" id="auc-volume-input-from">
			</div>
		</div>
		<div class="datepicker__input input --date --end">
			<div class="input__wrap">
				<input class="input__area" type="text" value="<?= $arParams["TO"]; ?>" name="date_volume_end" placeholder="To" readonly="" id="auc-volume-input-to">
			</div>
		</div>
		<button class="datepicker__btn btn --purple --sq --w2" id="auc-volume-button"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/t2-datepicker__btn.php"
					)
				);?></button>
	</form>
	<div class="result__elem-list">
		<?
			$summVal = 0;
			$summPrice = 0;
		?>
		<?foreach($arResult["SECTIONS"] as $arSection):?>
			<?
				$currentValue = (int)end($arSection["ELEMENTS"])["DISPLAY_PROPERTIES"]["VALUE"]["~VALUE"];
			?>

		<?foreach($arSection["ELEMENTS"] as $arItem):?>
			<?
			$summVal += $arItem["DISPLAY_PROPERTIES"]["VALUE"]["~VALUE"];
			$summValBlocks += $arItem["DISPLAY_PROPERTIES"]["VALUE"]["~VALUE"];
			$summPrice = $arItem["DISPLAY_PROPERTIES"]["PRICE"]["~VALUE"] * $arItem["DISPLAY_PROPERTIES"]["VALUE"]["~VALUE"];
			$summBlockPrice += $arItem["DISPLAY_PROPERTIES"]["PRICE"]["~VALUE"] * $arItem["DISPLAY_PROPERTIES"]["VALUE"]["~VALUE"];
			?>

			<?
				$activeDate = end($arSection["ELEMENTS"])["ACTIVE_FROM"];
				// $summPrice +=  $arItem["DISPLAY_PROPERTIES"]["PRICE"]["~VALUE"] * $arItem["DISPLAY_PROPERTIES"]["VALUE"]["~VALUE"];
				$summPrice +=  (int)$arItem["DISPLAY_PROPERTIES"]["PRICE_SUMM"]["~VALUE"];
			?>
		<?endforeach;?>

		<? if ($arSection["ID"] == 49): ?>
		<div class="result__elem-item"  id="auc-volume-zd-block">
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
						"PATH" => "/inc/t2-result-zd-t.php"
					)
				);?></div>
				<div class="result__elem-value">
					<? if ($arParams['FROM'] || $arParams['TO']) { ?>
						<?= number_format($summVal, 0, ',', ' '); ?>
					<? } else { ?>
						<?= number_format($currentValue, 0, ',', ' '); ?>
					<? } ?>
				</div>
			</div>
		</div>
		<?
			$summPrice = 0;
			$summVal = 0;
		?>
		<? endif; ?>

		<? if ($arSection["ID"] == 50): ?>
		<div class="result__elem-item" id="auc-volume-auto-block">
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
						"PATH" => "/inc/t2-result-auto-t.php"
					)
				);?></div>
				<div class="result__elem-value">
					<? if ($arParams['FROM'] || $arParams['TO']) { ?>
						<?= number_format($summVal, 0, ',', ' '); ?>
					<? } else { ?>
						<?= number_format($currentValue, 0, ',', ' '); ?>
					<? } ?>
				</div>
			</div>
		</div>
		<? endif; ?>

		<?endforeach;?>
		<?
		$total = $summValBlocks + trim($auction_value);
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
						"PATH" => "/inc/t2-result-all-t.php"
					)
				);?></div>
			<div class="result__elem-total" id="auc-volume-total">
			<?= implode('', $total) ?>
			</div>
		</div>
	</div>
</div>
