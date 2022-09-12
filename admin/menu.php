<?

###########################
#						  #
# module REDS GROUP		  #
# @copyright 2019 REDSGROUP #
#						  #
###########################

AddEventHandler("main", "OnBuildGlobalMenu", "kspMenuCorporatelight");

function kspMenuCorporatelight(&$arGlobalMenu, &$arModuleMenu)
{
	IncludeModuleLangFile(__FILE__);
	$moduleName = "stdkit.ksp";

	global $APPLICATION;
	$APPLICATION->SetAdditionalCss("/bitrix/css/".$moduleName."/menu.css");


	if($APPLICATION->GetGroupRight($moduleName) > "D")
	{
		$arMenu = array(
			"menu_id" => "ksp_corporatelight",
			"items_id" => "ksp_corporatelight",
			"text" => 'КСП',
			"sort" => 900,
			"items" => array(
				array(
					"text" => 'настройки сайта',
					"sort" => 10,
					"url" => "/bitrix/admin/settings.php?lang=".LANGUAGE_ID."&mid=".$moduleName."&mid_menu=1",
					"items_id" => "KSP_main",
				),
			),
		);
		$arGlobalMenu[] = $arMenu;
	}
}
