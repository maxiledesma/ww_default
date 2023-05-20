<?php
namespace Deviget\Setup\Setup\Patch\Data;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Cms\Api\Data\PageInterfaceFactory;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Store\Model\Store;

class CreateCmsAuthorPage
    implements DataPatchInterface
{
    const CMS_PAGE_TITLE = 'A little about me';
    const CMS_PAGE_CONTENT_HEADING = 'Sharing a little about my developer path';
    const CMS_PAGE_IDENTIFIER = 'a-little-about-me';
    const CMS_PAGE_CONTENT = <<<HTML
<style>#html-body [data-pb-style=RNS8OH9],#html-body [data-pb-style=S3E8Y52],#html-body [data-pb-style=X3MKT5Y]{background-position:left top;background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=RNS8OH9],#html-body [data-pb-style=X3MKT5Y]{justify-content:flex-start;display:flex;flex-direction:column}#html-body [data-pb-style=S3E8Y52]{align-self:stretch}#html-body [data-pb-style=X5VX5VQ]{display:flex;width:100%}#html-body [data-pb-style=QN9ST9G]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;background-size:cover;background-repeat:no-repeat;background-attachment:scroll;width:33.3333%;align-self:stretch}#html-body [data-pb-style=VMTJ8IU]{border-style:none}#html-body [data-pb-style=BPQJGTN],#html-body [data-pb-style=P387XOD]{max-width:100%;height:auto}#html-body [data-pb-style=FTPUQMS]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;background-size:cover;background-repeat:no-repeat;background-attachment:scroll;width:66.6667%;align-self:stretch}#html-body [data-pb-style=DOWFJE4]{margin-top:0;padding-top:0}@media only screen and (max-width: 768px) { #html-body [data-pb-style=VMTJ8IU]{border-style:none} }</style><div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="inner" data-pb-style="RNS8OH9"><h1 data-content-type="heading" data-appearance="default" data-element="main">Maximiliano Ledesma</h1><h2 data-content-type="heading" data-appearance="default" data-element="main">Magento Full-stack Developer</h2></div></div><div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="inner" data-pb-style="X3MKT5Y"><div class="pagebuilder-column-group ww-about-me" data-background-images="{}" data-content-type="column-group" data-appearance="default" data-grid-size="12" data-element="main" data-pb-style="S3E8Y52"><div class="pagebuilder-column-line" data-content-type="column-line" data-element="main" data-pb-style="X5VX5VQ"><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="QN9ST9G"><figure data-content-type="image" data-appearance="full-width" data-element="main" data-pb-style="VMTJ8IU"><img class="pagebuilder-mobile-hidden" src="{{media url=.renditions/wysiwyg/Screenshot_2023_04_05_082849.0.jpg}}" alt="" title="" data-element="desktop_image" data-pb-style="BPQJGTN"><img class="pagebuilder-mobile-only" src="{{media url=.renditions/wysiwyg/Screenshot_2023_04_05_082849.0.jpg}}" alt="" title="" data-element="mobile_image" data-pb-style="P387XOD"></figure><h2 data-content-type="heading" data-appearance="default" data-element="main">Contact info</h2><div data-content-type="text" data-appearance="default" data-element="main"><p><strong>Email:</strong> <a tabindex="0" href="mailto:maximilianoledesma@gmail.com">maximilianoledesma@gmail.com</a></p>
<p><strong>Phone:</strong> <a tabindex="0" href="tel:+5491130004111">+5491130004111</a></p>
<p><strong>LinkedIn:</strong> /maximiliano-gastón-ledesma-ab427630</p>
<p><strong>Website: </strong>http://www.maximilianoledesma.com</p>
<p>&nbsp;</p></div></div><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="FTPUQMS"><h2 data-content-type="heading" data-appearance="default" data-element="main" data-pb-style="DOWFJE4">Introduction</h2><div data-content-type="text" data-appearance="default" data-element="main"><p>I'm a Magento frontend developer since 2016 and working as a fullstack developer since early 2021.&nbsp;</p>
<p>I have experience with PHP, HTML5 and CSS3&nbsp;</p></div><h2 data-content-type="heading" data-appearance="default" data-element="main">My Magento Career Path</h2><div data-content-type="text" data-appearance="default" data-element="main"><p>Started to work in Magento 1 in early 2016 and been trained in the process. Later, in the same year had my first job as a trainee Magento 2 developer on Praxis IS (which later become part of Weidenhammer).</p>
<p>Worked there for 4 years and was involved in several projects for different clients like Medicine Man Gallery, Gertrude Hawk Chocolates, Tesoros, Sid Mashburn, GeoShack, and Hangers among others.</p>
<p>On all the mentioned projects, I worked as a front-end developer, and some of them had me as a lead developer.</p>
<p>After Praxis, I've been working with an Argentinian company called Mantik where started to work as a full-stack developer on a project called Vivienda Verde.</p>
<p>In the same year, changed Mantik for Redstage, where I was involved in the most challenging projects with a set of high-profile clients such as Apria Healthcare or Wolters Kluwer.&nbsp;<br><br>For those clients, I worked on highly custom features on Magento stores such as:</p>
<p><strong>Custom integrations: </strong>Worked to create integrations with self-developed ERP systems, taxes, shipping costs, customers, and product provision.</p>
<p><strong>Custom checkout flow: </strong>I've worked on the design and implementation of a complete custom checkout flow for one of the customers, where several integrations were applied (customer data, payment information, taxes, shipping costs, product configuration, and order submission) creating the integrations, forms, pages, validation instruments and submission process.</p>
<p>I've also been working as a front-end developer, then as a lead developer, teach lead, and technical architect.</p>
<p>As a tech lead, I had the opportunity to lead the team with mentoring, helping to reach goals, and designing and implementing processes such as local environment installation, git strategy, and code review process among other things.</p>
<p>As a technical architect, I worked closely with the client acting as a "translator" between them and the development team. Designed solutions and implementations along with different working strategies.</p>
<p>Currently, I'm working with Wolters Kluwer as a fronted developer.</p></div></div></div></div></div></div>
HTML;

    protected ModuleDataSetupInterface $moduleDataSetup;
    private PageRepositoryInterface $pageRepository;
    private PageInterfaceFactory $pageFactory;


    /**
     * Class Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageInterfaceFactory $pageFactory
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageInterfaceFactory $pageFactory,
        PageRepositoryInterface $pageRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @throws LocalizedException
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $pageData = [
            'title' => self::CMS_PAGE_TITLE,
            'page_layout' => '1column',
            'content_heading' => self::CMS_PAGE_CONTENT_HEADING,
            'identifier' => self::CMS_PAGE_IDENTIFIER,
            'content' => self::CMS_PAGE_CONTENT,
            'is_active' => 1,
            'store_id' => Store::DEFAULT_STORE_ID,
        ];

        $page = $this->pageFactory->create(['data' => $pageData]);

        $this->pageRepository->save($page);

        $this->moduleDataSetup->getConnection()->endSetup();
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
