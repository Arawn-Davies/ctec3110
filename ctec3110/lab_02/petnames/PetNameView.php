<?php

//namespace Petnames;

class PetNameView
{
    private $output_html;
    private $pet_messages;

    public function __construct()
    {
        $this->output_html = '';
        $this->pet_messages = [];
    }

    public function setOutput($pet_messages)
    {
        $this->pet_messages = $pet_messages;
    }

    public function createOutput()
    {
        $pet_message_1 = $this->pet_messages[1];
        $pet_message_2 = $this->pet_messages[2];

        $this->output_html = <<< HTML
<!DOCTYPE html>
<html lang="gb">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Author" content="Clinton Ingrams" />
	<title>Pets with Objects</title>
</head>
<body>
	<h2>Pets with Objects</h2>
	<p>$pet_message_1</p>
	<p>$pet_message_2</p>
</body>
</html>
HTML;
    }

    public function getOutputHtml()
    {
        return $this->output_html;
    }
}
