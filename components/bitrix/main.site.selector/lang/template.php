<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
function getAliasLang($LID) {
	$langName = '';
	switch($LID) {
		case 't1':
			$langName = 'РУС';
			break;
		case 't2':
			$langName = 'ENG';
			break;
	}

	return $langName;
}

$currentLang = '';
foreach ($arResult["SITES"] as $key => $arSite){

	if ($arSite["CURRENT"] == "Y"){
		$currentLang = getAliasLang($arSite["LID"]);
	}

}
?>
<div class="header__lang lang">
	<div class="lang__head">
	  <div class="lang__name"><?= $currentLang ?></div>
	  <div class="lang__icon">
		<img src="/upload/icons/chevron-down.svg" alt="">
	  </div>
	</div>
	<div class="lang__body">
	  <div class="lang__list">
			<?foreach ($arResult["SITES"] as $key => $arSite):?>
				<?if ($arSite["CURRENT"] != "Y"):?>
					<a class="lang__item" href="<?if(is_array($arSite['DOMAINS']) && $arSite['DOMAINS'][0] <> '' || $arSite['DOMAINS'] <> ''):?>http://<?endif?><?=(is_array($arSite["DOMAINS"]) ? $arSite["DOMAINS"][0] : $arSite["DOMAINS"])?><?=$arSite["DIR"]?>" title="<?=$arSite["NAME"]?>">
					  <div class="lang__name"><?= getAliasLang($arSite["LID"]) ?></div>
					</a>
				<?endif?>
			
			<?endforeach;?>
		</div>
	</div>
 </div>