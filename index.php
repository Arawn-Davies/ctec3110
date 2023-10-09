<?php
$eol = "\n";
$output = '<!DOCTYPE html >' . $eol;
$output .= '<head lang="en">' . $eol;
$output .= '<meta http-equiv="Content-Type" content="text/html;
charset=utf-8" />' . $eol;
$output .= '<meta name="Author" content="Arawn Davies" />' . $eol;
$output .= '<title>Hello World</title>' . $eol;
$output .= '</head>' . $eol;
$output .= '<body>' . $eol;
$output .= '<h2>Hello World!</h2>' . $eol;
$output .= '<p>Today\'s date is ' . gmdate("M d Y") . '</p>' . $eol;
$output .= '<p>Welcome to Arawn\'s CTEC3110 Secure Web Application Development Labsite.</p>' . $eol;
$output .= '<p>My name is Arawn Davies and I am a final year undergraduate computer science student at De Montfort University in Leicester.<br />I hope you enjoy taking a look around the various pages on this site, all written in PHP 8.2</p>' . $eol;
$output .= '</body>' . $eol;
$output .= '</html>' . $eol;
echo $output;
?>