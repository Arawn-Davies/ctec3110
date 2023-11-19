<?php

class BitwiseResultsController
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

    public function bitwiseCreateResults(): void
    {
        $bitwise_result = [];

        $bitwise_result = $this->bitwiseValidate();

        if ($bitwise_result['sanitised_value'] !== false)
        {
            $bitwise_result = $this->bitwiseModel($bitwise_result['sanitised_value']);
        }

        $html_output = $this->bitwiseView($bitwise_result);
    }

    private function bitwiseValidate(): mixed
    {
        require 'src/BitwiseResultValidate.php';
        $validate = new BitwiseResultValidate();
        $validate->sanitiseInput();
        $validate_result = $validate->getSanitisedInput();

        return $validate_result;
    }

    private function bitwiseModel($bitwise_value): array
    {
        require 'src/BitwiseResultModel.php';
        $bitwise_model = new BitwiseResultModel();

        $bitwise_model->setBitwiseValue($bitwise_value);
        $bitwise_model->doBitwiseProcessing();
        $bitwise_result = $bitwise_model->getBitwiseResult();

        return $bitwise_result;
    }

    private function bitwiseView($bitwise_result): void
    {
        require 'src/BitwiseResultView.php';
        $result_page = new BitwiseResultView();

        $result_page->setOutputValue($bitwise_result);
        $result_page->createOutputPage();
        $this->html_output = $result_page->getHtmlOutput();
    }
}
