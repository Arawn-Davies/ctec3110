<?php

declare(strict_types=1);

class PetNameView
{
    private string $output_html;
    
    public function __construct()
    {
    $this->output_html = '';
    }

    public function createOutput($output_1, $output_2): void
    {
        $this->output_html = <<< HTML
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <meta name="Author" content="Clinton Ingrams" />
                    <title>Pets with Objects</title>
                </head>
                <body>
                    <h2>Pets with Objects</h2>
                    <p>$output_1</p>
                    <p>$output_2</p>
                </body>
            </html>
        HTML;
    }

     public function getOutputHtml(): string
    {
        return $this->output_html;
    }
}