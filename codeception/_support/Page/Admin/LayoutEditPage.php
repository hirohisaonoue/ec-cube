<?php


namespace Page\Admin;


class LayoutEditPage extends AbstractAdminPageStyleGuide
{
    public static $未使用ブロックアイテム = ['css' => '#unused-block div.sort'];
    public static $登録完了メッセージ = ['xpath' => "//div[@class='alert alert-success alert-dismissible fade show m-3']"];

    /**
     * LayoutEditPage constructor.
     */
    public function __construct(\AcceptanceTester $I)
    {
        parent::__construct($I);
    }

    public static function at($I)
    {
        $page = new self($I);
        return $page->atPage('レイアウト管理コンテンツ管理');
    }

    public function 登録()
    {
        $this->tester->waitForElementVisible('#form1 > div > div.c-conversionArea > div > div > div:nth-child(2) > div > div > button');
        $this->tester->click('#form1 > div > div.c-conversionArea > div > div > div:nth-child(2) > div > div > button');
        return $this;
    }

    public function ブロックを移動($blockName, $dest, $timeout = 10)
    {
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'detail_box__layout_item')][div[div[1][a[text()='${blockName}']]]]"], $timeout);
        $this->tester->dragAndDrop(['xpath' => "//div[contains(@id, 'detail_box__layout_item')][div[div[1][a[text()='${blockName}']]]]"], $dest);
        return $this;
    }

    public function コンテキストメニューを開く($blockName)
    {
        $this->tester->click(['xpath' => "//div[contains(@id, 'detail_box__layout_item')][div[div[1][a[text()='${blockName}']]]]/div/div[2]"]);
        return $this;
    }

    public function コンテキストメニューで上に移動($blockName)
    {
        $this->コンテキストメニューを開く($blockName);
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[1]"]);
        $this->tester->click(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[1]"]);
        return $this;
    }

    public function コンテキストメニューで下に移動($blockName)
    {
        $this->コンテキストメニューを開く($blockName);
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[2]"]);
        $this->tester->click(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[2]"]);
        return $this;
    }

    public function コンテキストメニューでセクションに移動($blockName)
    {
        $this->コンテキストメニューを開く($blockName);
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[3]"]);
        $this->tester->wait(1);
        $this->tester->click(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[3]"]);
        $this->tester->waitForElementVisible(['id' => "move-to-section"]);
        $this->tester->wait(1);
        $this->tester->click(['id' => "move-to-section"]);
        $this->tester->waitForElementNotVisible(['id' => "move-to-section"]);
        $this->tester->wait(1);
        return $this;
    }

    public function コンテキストメニューでコードプレビュー($blockName, $element = null, $timeout = 10)
    {
        $this->コンテキストメニューを開く($blockName);
        $this->tester->scrollTo('//div[contains(@id, \'popover\')]/div[2]/div/a[4]', 0, 0);
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[4]"]);
        $this->tester->click(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[4]"]);
        $this->tester->waitForElementVisible(['id' => "codePreview"]);
        if ($element) {
            $this->tester->waitForElementVisible($element, $timeout);
        }
        $this->tester->click(['xpath' => "//*[@id='codePreview']/div/div/div[3]/button[1]"]);
        return $this;
    }

    public function プレビュー()
    {
        $this->tester->click("#preview_box__preview_button > button");
        return $this;
    }

    public function 検索ブロック名($value)
    {
        $this->tester->fillField(['css' => '#unused-block div.first input'], $value);
        return $this;
    }
}
