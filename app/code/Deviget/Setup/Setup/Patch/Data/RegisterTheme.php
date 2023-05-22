<?php
namespace Deviget\Setup\Setup\Patch\Data;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Theme\Model\Theme\Registration;
use Magento\Framework\App\Config\ConfigResource\ConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Framework\App\ResourceConnection;
use Magento\Store\Model\StoreManagerInterface;

class RegisterTheme
    implements DataPatchInterface
{
    const WW_THEME_CODE = 'Deviget/ww_default';
    const THEME_TABLE = 'theme';
    const DEFAULT_WEBSITE_ID = 1;

    protected Registration $themeRegistration;
    protected ModuleDataSetupInterface $moduleDataSetup;
    protected ConfigInterface $config;
    protected ResourceConnection $connection;
    protected StoreManagerInterface $storeManager;

    /**
     * Class Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param Registration $themeRegistration
     * @param ConfigInterface $config
     * @param ResourceConnection $connection
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        Registration $themeRegistration,
        ConfigInterface $config,
        ResourceConnection $connection,
        StoreManagerInterface $storeManager
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->themeRegistration = $themeRegistration;
        $this->config = $config;
        $this->connection = $connection;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritdoc
     * @throws LocalizedException
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        // Theme registration on the database
        $this->themeRegistration->register();

        // Set the theme for the default store
        $this->config->saveConfig(
            'design/theme/theme_id',
            $this->getThemeIdByCode(),
            ScopeInterface::SCOPE_STORES,
            $this->getStoreIdByWebsiteId()
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * Returns the theme WW theme id
     *
     * @return int
     */
    protected function getThemeIdByCode(): int
    {
        $connection = $this->connection->getConnection();
        $themeTable = $this->connection->getTableName(self::THEME_TABLE);

        $request = $connection->select()
            ->from($themeTable, ['theme_id'])
            ->where('code = ?', self::WW_THEME_CODE)
        ;

        $themeId = $connection->fetchOne($request);

        return (int) $themeId;
    }

    /**
     * Returns the default store id
     *
     * @throws LocalizedException
     */
    protected function getStoreIdByWebsiteId(): int
    {
        return $this->storeManager->getWebsite(self::DEFAULT_WEBSITE_ID)->getDefaultStore()->getId();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
