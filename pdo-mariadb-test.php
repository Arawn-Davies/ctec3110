<?php
header("Content-Type: text/plain");
const DDBMS = "mysql";
const HOST = "localhost";
const PORT = 3306;
const DATABASE = "p3ttestdb";
const USER = "p3tuser";
const PASSWORD = "p3tpassword";
const DSN_CONNECTION_STRING = DDBMS . ':host=' . HOST . ';port=' . PORT . ';dbname=' .
    DATABASE;
const QUERY = 'SELECT column1, NOW() as "now" FROM message';
$output_text = '';
try
{
    $output_text .= "Connection parameters: \n";
    $output_text .= " rdbms server = [" . DDBMS . "]\n";
    $output_text .= " host = [" . HOST . "]\n";
    $output_text .= " port = [" . PORT . "]\n";
    $output_text .= " database = [" . DATABASE . "]\n";
    $output_text .= " connection string = [" . DSN_CONNECTION_STRING . "]\n";
    $output_text .= " username = [" . USER . "]\n";
    $output_text .= " password = [**********]\n\n";
    $output_text .= "Attempting to connect using PDO ...\n\n";
    $db_handle = new PDO(DSN_CONNECTION_STRING, USER, PASSWORD);
    $output_text .= "Attempting to run query [" . QUERY . "] ...\n";
    $resultStatement = $db_handle->query(QUERY);
    $output_text .= "Retrieving the query result ... \n\n";
    $resultArray = $resultStatement->fetch(PDO::FETCH_ASSOC);
    $output_text .= "The returned text is [" . $resultArray['column1'] . "]\n\n";
    $output_text .= "Query run at [" . $resultArray['now'] . "]\n";
    $output_text .= "Releasing PDO resources ...\n";
    $db_handle = null;
}
catch (PDOException $e)
{
    $output_text .= "Error occurred, details as follows~~~~~~~~~~~~~~~~:\n";
    $output_text .= $e->getMessage() . "\n";
    $output_text .= "End of error
details~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
}
echo $output_text;