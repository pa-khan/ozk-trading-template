<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<?

CJSCore::Init(array('ajax'));

$otherNewsCat;
$searchWord;
switch(SITE_ID) {
	case 't1':
		$searchWord = 'Поиск...';
		$otherNewsID = 8;
		$otherNewsDir = 220;
		break;
	case 't2':
		$searchWord = 'Search...';
		$otherNewsID = 59;
		$otherNewsDir = 221;
		break;
} ?>
<html>
	<head>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
		<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/sys/libs/air-datepicker/dist/air-datepicker.css?ver=1650736128397">
		<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/sys/css/style.css?ver=1650736128399">
	</head>
	<body class="lang-<?= SITE_ID ?>">
	<div class="inner">
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
		<header class="header an fadeIn">
        <div class="case">
          <div class="header__wrap row">
			<? if ($APPLICATION->GetCurPage(false) === SITE_DIR) { ?>
            <div class="header__logo logo">
              <?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/logo-violet.php"
					)
				);?>
            </div>
			<? } else { ?>
			<a href="<?= SITE_DIR ?>" class="header__logo logo">
              <?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/logo-violet.php"
					)
				);?>
            </a>
			<? } ?>
            <div class="header__nav nav">
              <?$APPLICATION->IncludeComponent("bitrix:menu", "nav", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "2",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"COMPONENT_TEMPLATE" => ".default",
		"MENU_THEME" => "site"
	),
	false
);?>
            </div>
            <div class="header__ham ham">
              <div></div>
              <div></div>
              <div></div>
            </div>
            <div class="header__actions row">
			  <form class="header__search search" action="<?= SITE_DIR ?>search/index.php">
                <img src="/upload/icons/search.svg" alt="">
                <div class="search__wrap row">
                  <div class="search__input input --search">
					<input class="input__area" type="search" name="q" value="<?= $_GET['q'] ? $_GET['q'] : null ?>" placeholder="<?= $searchWord ?>">
                  </div>
                  <button class="search__btn btn --yellow-pur"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-search__btn.php"
					)
				);?></button>
                </div>
              </form>
              <?$APPLICATION->IncludeComponent(
	"bitrix:main.site.selector", 
	"lang", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"SITE_LIST" => array(
			0 => "t1",
			1 => "t2",
		),
		"COMPONENT_TEMPLATE" => "lang"
	),
	false
);?>
            </div>
          </div>
        </div>
      </header>
	  <main class="main fadePage">
		<? if ($APPLICATION->GetCurPage(false) === SITE_DIR) { ?>
		
		<? } ?>

		<? if ($APPLICATION->GetCurPage(false) !== SITE_DIR) { ?>
        <div class="sidepage page-padding an fadeIn">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", Array(
	"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
		"SITE_ID" => "t1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
		"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
			<? 
				$sidePage = (CSite::InDir(SITE_DIR.'about/') || CSite::InDir(SITE_DIR.'auctions/') || CSite::InDir(SITE_DIR.'press_center/')) && $APPLICATION->GetCurPage(false) != '/en/press_center/';
				$classSideTitlte = $APPLICATION->GetCurPage(false) === SITE_DIR.'prices/item.php' ? 'h3' : 'h2';
 			?>
          <div class="case">
            <div class="sidepage__wrap">
              <div class="sidepage__main<? if (!$sidePage) echo ' --full'; ?>">
				<? if ($APPLICATION->GetCurPage(false) !== SITE_DIR.'prices/') { ?>
				  <? if (($APPLICATION->GetCurPage(false) == SITE_DIR.'press_center/news/' || !CSite::InDir(SITE_DIR.'press_center/news/')) && ($APPLICATION->GetCurPage(false) == SITE_DIR.'press_center/extras/' || !CSite::InDir(SITE_DIR.'press_center/extras/')) && ($APPLICATION->GetCurPage(false) == '/en/press_center/' || !CSite::InDir('/en/press_center/'))) { ?>
						<div class="sidepage__title <?= $classSideTitlte ?>">
						  <h1><? $APPLICATION->ShowTitle('H1') ?></h1>
						</div>
					<? } ?>
				<? } else { ?>
				<div class="sidepage__head">
					<div class="sidepage__title --no-margin h2"><h1><? $APPLICATION->ShowTitle('H1') ?></h1></div>
					<div class="sidepage__title-note"><?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/inc/".SITE_ID."-sidepage__title-note.php"
					)
				);?></div>
				</div>
				<? }  ?>
                <div class="sidepage__content">
		<? } ?>

					
