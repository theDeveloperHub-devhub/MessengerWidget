<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Fieldset;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Phrase;

class Information extends Fieldset
{
    /**
     * @var string
     */
    private $userGuide = '';

    /**
     * @var array
     */
    private $enemyExtensions = [];

    /**
     * @var string
     */
    private $content;

    /**
     * Render fieldset html
     *
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element): string
    {
        $html = $this->_getHeaderHtml($element);
        $this->setContent(__('Please update the module. Re-upload it and replace all the files.'));

        $this->_eventManager->dispatch(
            'devhub_base_add_information_content',
            ['block' => $this]
        );

        $html .= $this->getContent();
        $html .= $this->_getFooterHtml($element);

        $html = str_replace(
            'devhub_information]" type="hidden" value="0"',
            'devhub_information]" type="hidden" value="1"',
            $html
        );
        $html = preg_replace('(onclick=\"Fieldset.toggleCollapse.*?\")', '', $html);

        return $html;
    }

    /**
     * @return string
     */
    public function getUserGuide(): string
    {
        return $this->userGuide;
    }

    /**
     * @param string $userGuide
     */
    public function setUserGuide(string $userGuide): void
    {
        $this->userGuide = $userGuide;
    }

    /**
     * @return array
     */
    public function getEnemyExtensions(): array
    {
        return $this->enemyExtensions;
    }

    /**
     * @param array $enemyExtensions
     */
    public function setEnemyExtensions(array $enemyExtensions): void
    {
        $this->enemyExtensions = $enemyExtensions;
    }

    /**
     * @return Phrase|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param Phrase|string $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }
}
