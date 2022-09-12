<?
namespace KSP;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

class Main {

	public function appendScriptsToPage() {

		if(!defined("ADMIN_SECTION") && $ADMIN_SECTION !== true) {
            $module_id = pathinfo(dirname(__DIR__))["basename"];
            if (Option::get($module_id, "double_phone_switch_on") == "Y" && Option::get($module_id, "site_".SITE_ID) == "Y") {
    			Asset::getInstance()->addString(
    				"<script id=\"".str_replace(".", "_", $module_id)."-params\" data-params='".json_encode(
    					array(
    						"double_phone_switch_on" 	=> Option::get($module_id, "double_phone_switch_on", "Y")
    					)
    				)."'></script>",
    				true
    			); 
				
                // Asset::getInstance()->addJs("/bitrix/js/".$module_id."/script.min.js");
                Asset::getInstance()->addCss("/bitrix/css/".$module_id."/style.min.css");
    		}
        }
		return false;
	}
}
