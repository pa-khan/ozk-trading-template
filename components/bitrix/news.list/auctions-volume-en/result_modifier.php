<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$dbResSect = CIBlockSection::GetList(
	Array("SORT"=>"ASC"),
	Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'])
);
//Получаем разделы и собираем в массив
while($sectRes = $dbResSect->GetNext())
{
	$arSections[$sectRes['ID']] = $sectRes;
}

foreach($arResult["ITEMS"] as $key=>$arItem) {
	$arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'] = $arItem;
}

$arResult["SECTIONS"] = $arSections;





// получение родительских разделов
foreach($arResult["ITEMS"] as $cell=>$arElement) {
	$navChain = CIBlockSection::GetNavChain($arElement['IBLOCK_ID'], $arElement['IBLOCK_SECTION_ID']);
	while ($arNav=$navChain->GetNext()) {
		if ($arNav["DEPTH_LEVEL"] == 1) {
			$arSections[$arNav['ID']] = $arNav;
		}
	}
}

//Собираем  массив из Разделов и элементов
foreach($arSections as $arSection){
	foreach($arResult["ITEMS"] as $key=>$arItem){
		$navChain = CIBlockSection::GetNavChain($arItem['IBLOCK_ID'], $arItem['IBLOCK_SECTION_ID']);
		while ($arNav=$navChain->GetNext()) {
			if ($arNav["DEPTH_LEVEL"] == 1) {
				$arNavs = $arNav;
			}
		}

		if($arSection['ID'] == $arNavs['ID']){
			$arSection['ELEMENTS'][] =  $arItem;
		}
	}
	$arElementGroups[] = $arSection;
}

$arResult["SECTIONS"] = $arElementGroups;