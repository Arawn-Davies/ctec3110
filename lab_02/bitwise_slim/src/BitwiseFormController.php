<?php

class BitwiseFormController
{
    private $html_output;

    public function __construct()
    {
        $this->html_output = '';
    }

    public function __destruct() {}

    public function getHtmlOutput(): string
    {
        return $this->html_output;
    }

    public function bitwiseCreateForm(): void
    {
        require 'src/BitwiseFormView.php';
        $result_page = new BitwiseFormView();

        $result_page->createForm();
        $this->html_output = $result_page->getHtmlOutput();
    }
}