<?php
namespace Carawebs\Contacts;

/**
 * @NOTE IN PROGRESS
 */
class SetupCustomPostTypes
{
    public function __construct($path)
    {
        $this->cptConfigPath = $path;
        \Carawebs\CustomContent\CptLoader::create()->setConfigPath($path)->setup();
    }

    function setCptPath($cptConfigPath)
    {
        $this->cptConfigPath = $cptConfigPath;
    }

    private function initCustomPostTypes()
    {
        if (!file_exists($this->cptConfigPath)) return;
        add_action( 'init', function() {
            $this->setupCPTs($this->cptConfigPath);
        });
    }

    private function initCustomTaxonomies()
    {
        if (!file_exists($this->taxConfigPath)) return;
        add_action( 'init', function() {
            $this->setupCustomTaxonomies();
        });
    }

    private function setupCPTs() {
        if (!file_exists($this->cptConfigPath)) return;
        new CPT\Setup(
            new CPT\Config($this->cptConfigPath),
            new CPT\Register()
        );
    }

    private function setupCustomTaxonomies()
    {
        if (!file_exists($this->taxConfigPath)) return;
        $TaxSetup = new Taxonomy\Setup(
            new Taxonomy\Config($this->taxConfigPath),
            new Taxonomy\Register()
        );
    }
}
