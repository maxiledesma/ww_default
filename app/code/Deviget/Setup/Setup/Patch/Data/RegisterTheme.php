<?php
namespace Deviget\Setup\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Theme\Model\Theme\Registration;
use Magento\Framework\App\Config\ConfigResource\ConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Framework\App\ResourceConnection;

class RegisterTheme
    implements DataPatchInterface
{
    const WW_THEME_CODE = 'Deviget/ww_default';
    const THEME_TABLE = 'theme';
    protected Registration $themeRegistration;
    protected ModuleDataSetupInterface $moduleDataSetup;
    protected ConfigInterface $config;
    protected ResourceConnection $connection;

    /**
     * Class Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param Registration $themeRegistration
     * @param ConfigInterface $config
     * @param ResourceConnection $connection
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        Registration $themeRegistration,
        ConfigInterface $config,
        ResourceConnection $connection
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->themeRegistration = $themeRegistration;
        $this->config = $config;
        $this->connection = $connection;
    }

    /**
     * @inheritdoc
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
            ScopeInterface::SCOPE_STORE,
            Store::DEFAULT_STORE_ID
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
