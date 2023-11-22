<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require_once 'classes/CheckPrimeValidate.php';
require_once 'classes/CheckPrimeModel.php';
require_once 'classes/CheckPrimeView.php';
$app->post(
 '/checkprimenumber',
 function (Request $request, Response $response): Response
 {
 $page_content = [];
 $check_prime_validate = new CheckPrimeValidate();
 $check_prime_validate->sanitiseInput();
 $validate_result = $check_prime_validate->getValidatedPrimeCheck();
 $page_content['error_message'] = false;
 if ($validate_result['check_prime_error'])
 {
 $page_content['error_message'] = true;
 }
 else
 {
 $page_content['cleaned_guess'] =
$validate_result['check_prime_validated'];
 $check_prime = new CheckPrimeModel();
 $check_prime->setPrimeCheckValue($page_content['cleaned_guess']);
 $check_prime->primeCheck();
 $page_content['prime_check_result'] = $check_prime->getPrimeCheckResult();
 }
 $view_result_page = new CheckPrimeView();
 $view_result_page->setOutputValues($page_content);
 $view_result_page->createOutputPage();
 $html = $view_result_page->getOutputHtml();
 $response->getBody()->write($html);
 return $response;
 }
);