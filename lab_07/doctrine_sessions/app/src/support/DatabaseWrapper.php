<?php

/**
 * DatabaseWrapperper.php
 *
 * Access the sessions database
 *
 * Author: CF Ingrams
 * Email: <clinton@cfing.co.uk>
 * Date: 22/10/2017
 *
 * @author CF Ingrams <clinton@cfing.co.uk>
 * @copyright CFI
 */

namespace DoctrineSessions\Support;

class DatabaseWrapper
{
    private $database_handle;
    private $sql_queries;
    private $stmt;
    private $errors;

    public function __construct()
    {
        $this->database_handle = null;
        $this->sql_queries = null;
        $this->stmt = null;
        $this->errors = [];
    }

    public function __destruct() { }

    public function setDatabaseHandle($database_handle): void
    {
        $this->database_handle = $database_handle;
    }

    public function setSqlQueries($sql_queries): void
    {
        $this->sql_queries = $sql_queries;
    }

    public function storeSessionVar($session_key, $session_value): array
    {

        if ($this->sessionVarExists($session_key) === true)
        {
            $this->setSessionVar($session_key, $session_value);
        }
        else
        {
            $this->createSessionVar($session_key, $session_value);
        }

        return($this->errors);
    }

    private function sessionVarExists($session_key): bool
    {
        $session_var_exists = false;
        $query_string = $this->sql_queries->checkSessionVar();

        $query_parameters = [
            ':local_session_id' => session_id(),
            ':session_var_name' => $session_key
        ];

        $this->safeQuery($query_string, $query_parameters);

        if ($this->countRows() > 0)
        {
            $session_var_exists = true;
        }
        return $session_var_exists;
    }

    private function createSessionVar($session_key, $session_value)
    {
        $query_string = $this->sql_queries->createSessionVar();

        $query_parameters = [
            ':local_session_id' => session_id(),
            ':session_var_name' => $session_key,
            ':session_var_value' => $session_value
        ];

        $this->safeQuery($query_string, $query_parameters);
    }

    private function setSessionVar($session_key, $session_value)
    {
        $query_string = $this->sql_queries->setSessionVar();

        $query_parameters = [
            ':local_session_id' => session_id(),
            ':session_var_name' => $session_key,
            ':session_var_value' => $session_value
        ];

        $this->safeQuery($query_string, $query_parameters);
    }

    public function safeQuery($query_string, $query_parameters = null)
    {
        $database_query_execute_error = false;

        try
        {
            $this->database_handle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->prepared_statement = $this->database_handle->prepare($query_string);

            $execute_result = $this->prepared_statement->execute($query_parameters);
            $this->database_connection_messages['execute-OK'] = $execute_result;
        }
        catch (\PDOException $exception_object)
        {
            $error_message  = 'PDO Exception caught. ';
            $error_message .= 'Error with the database access. ';
            $error_message .= 'SQL query: ' . $query_string;
            $error_message .= 'Error: ' . print_r($this->prepared_statement->errorInfo(), true) . "\n";
            // NB would usually output to file for sysadmin attention
            $database_query_execute_error = true;
            $this->database_connection_messages['sql-error'] = $error_message;
            $this->database_connection_messages['pdo-error-code'] = $this->prepared_statement->errorInfo();
            trigger_error($exception_object);
        }
        $this->database_connection_messages['database-query-execute-error'] = $database_query_execute_error;
        return $this->database_connection_messages;
    }
//    public function safeQuery($query_string, $params = null)
//    {
//        $this->errors['db_error'] = false;
//        $query_string = $query_string;
//        $query_parameters = $params;
//
//        try
//        {
//            $temp = array();
//
//            $this->stmt = $this->db_handle->prepare($query_string);
//
//            // bind the parameters
//            if (sizeof($query_parameters) > 0)
//            {
//                foreach ($query_parameters as $param_key => $param_value)
//                {
//                    $temp[$param_key] = $param_value;
//                    $this->stmt->bindParam($param_key, $temp[$param_key], PDO::PARAM_STR);
//                }
//            }
//            // execute the query
//            $execute_result = $this->stmt->execute();
//            $this->errors['execute-OK'] = $execute_result;
//        }
//        catch (PDOException $exception_object)
//        {
//            $error_message  = 'PDO Exception caught. ';
//            $error_message .= 'Error with the database access.' . "\n";
//            $error_message .= 'SQL query: ' . $query_string . "\n";
//            $error_message .= 'Error: ' . var_dump($this->stmt->errorInfo(), true) . "\n";
//            // NB would usually output to file for sysadmin attention
//            $this->errors['db_error'] = true;
//            $this->errors['sql_error'] = $error_message;
//        }
//        return $this->errors['db_error'];
//    }

    public function countRows()
    {
        $num_rows = $this->stmt->rowCount();
        return $num_rows;
    }

    public function safeFetchRow()
    {
        $record_set = $this->stmt->fetch(PDO::FETCH_NUM);
        return $record_set;
    }

    public function safeFetchArray()
    {
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->stmt->closeCursor();
        return $row;
    }

    public function lastInsertedID()
    {
        $sql_query = 'SELECT LAST_INSERT_ID()';

        $this->safeQuery($sql_query);
        $last_inserted_id = $this->safeFetchArray();
        $last_inserted_id = $last_inserted_id['LAST_INSERT_ID()'];
        return $last_inserted_id;
    }
}
