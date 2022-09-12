<?

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\EventManager;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

class stdkit_ksp extends CModule
{
    public $MODULE_ID = 'stdkit.ksp';
    public function __construct()
    {
        $arModuleVersion = array();

        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        $MODULE_ID = 'stdkit.ksp';
        $this->MODULE_ID = 'stdkit.ksp';
        $this->MODULE_NAME = Loc::getMessage('KSP_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('KSP_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = Loc::getMessage('KSP_MODULE_PARTNER_NAME');
        // $this->PARTNER_URI = 'https://stdkit.ru';
    }

    public function InstallFiles(){

    	/*CopyDirFiles(
    		__DIR__."/assets/scripts",
    		Application::getDocumentRoot()."/bitrix/js/".$this->MODULE_ID."/",
    		true,
    		true
    	);*/

    	CopyDirFiles(
    		__DIR__."/assets/styles",
    		Application::getDocumentRoot()."/bitrix/css/".$this->MODULE_ID."/",
    		true,
    		true
    	);

        CopyDirFiles(
    		__DIR__."/assets/images",
    		Application::getDocumentRoot()."/bitrix/images/".$this->MODULE_ID."/",
    		true,
    		true
    	);

    	return false;
    }

    // Событие отрисовки
    public function InstallEvents(){

    	EventManager::getInstance()->registerEventHandler(
    		"main",
    		"OnBeforeEndBufferContent",
    		$this->MODULE_ID,
    		"KSP\Main",
    		"appendScriptsToPage"
    	);

    	return false;
    }

    public function doInstall()
    {
        if(CheckVersion(ModuleManager::getVersion("main"), "14.00.00")) {

    		$this->InstallFiles();
    		$this->installDB();
    		ModuleManager::registerModule($this->MODULE_ID);
    		$this->InstallEvents();
    	}
        else {

    		$APPLICATION->ThrowException(
    			Loc::getMessage("KSP_INSTALL_ERROR_VERSION")
    		);
    	}

    }

    public function doUninstall()
    {
        $this->uninstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        // if (Loader::includeModule($this->MODULE_ID))
        // {
        //     ExampleTable::getEntity()->createDbTable();
        //}
        return false;
    }

    public function uninstallDB()
    {
        // if (Loader::includeModule($this->MODULE_ID))
        // {
        //     $connection = Application::getInstance()->getConnection();
        //     $connection->dropTable(ExampleTable::getTableName());
        // }
        return false;
    }

    public function UnInstallFiles() {

    	/*Directory::deleteDirectory(
    		Application::getDocumentRoot()."/bitrix/js/".$this->MODULE_ID
    	);*/

    	Directory::deleteDirectory(
    		Application::getDocumentRoot()."/bitrix/css/".$this->MODULE_ID
    	);

    	return false;
    }

    public function UnInstallEvents(){

    	EventManager::getInstance()->unRegisterEventHandler(
    		"main",
    		"OnBeforeEndBufferContent",
    		$this->MODULE_ID,
    		"KSP\Main",
    		"appendScriptsToPage"
    	);

    	return false;
    }
}
