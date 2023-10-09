<?php

class CheckPrimeView
{
    private $page_content;
    private $check_prime_result_message;
    private $html_page;
    public function __construct()
    {
        $this->page_content = [];
    }

    public function __destruct()
    {
    }

    public function setOutputValues($arr_page_content)
    {
        $this->page_content = $arr_page_content;
    }

    private function getResultMessage()
    {
        $check_prime_result_message = '';
        if ($this->page_content['error_message']) {
            $check_prime_result_message .= 'Ooops - there was a problem with the number you entered';
        } else {
            $guess_value = $this->page_content['cleaned_guess'];
            $check_prime_result_message .= 'You entered ' . $guess_value . ' to be tested for prime-ness<br />';
            if ($this->page_content['prime_check_result']) {
                $check_prime_result_message .= 'The number you entered is a prime number';
            } else {
                $check_prime_result_message .= 'The number you entered is not a prime number';
            }
        }
        $this->check_prime_result_message = $check_prime_result_message;
    }

    public function createOutputPage()
    {
        $this->getResultMessage();
        $homepage_address = substr($_SERVER['PHP_SELF'], 0, -strlen('index.php'));
        $page_title = 'And the result is...';
        $page_heading = 'Prime Numbers';

        $check_prime_result_message = $this->check_prime_result_message;

        $html_output = <<< HTMLOUTPUT
<!DOCTYPE html >
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>$page_title</title>
</head>
<body>
	<h2>$page_heading</h2>
	<p>$check_prime_result_message</p>
	<p><a href="$homepage_address">Try again</a></p>
</body>
</html>
HTMLOUTPUT;
        $this->html_page = $html_output;
    }

    // returns the completed html page
    public function getOutputHtml()
    {
        return $this->html_page;
    }
}
