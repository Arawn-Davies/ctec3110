<?php
/**
 * Model.php
 *
 * stores the validated values in the relevant storage location
 *
 * Author: CF Ingrams
 * Email: <clinton@cfing.co.uk>
 * Date: 22/10/2017
 *
 *
 * @author CF Ingrams <clinton@cfing.co.uk>
 * @copyright CFI
 *
 */

namespace DoctrineSessions\models;

use Doctrine\DBAL\DriverManager;

class StoreSessionDetailsModel
{

    public function __construct(){}

    public function __destruct() { }

    public function storeSessionData(
        $container,
        array $settings,
        object $doctrine_queries,
        array $cleaned_parameters
    )
    {
        $server_type = $cleaned_parameters['server_type'];

        switch ($server_type)	{
            case 'database':
                $storage_result = $this->storeDataInDatabase($container, $settings, $doctrine_queries, $cleaned_parameters);
                break;
            case 'file':
            default:
                $storage_result = $this->storeDataInSessionFile($container, $cleaned_parameters);
        }
        return $storage_result;
    }

    private function storeDataInSessionFile($container, $cleaned_parameters)
    {
        $store_result = false;
        $session_wrapper = $container->get('sessionWrapper');
        $username = $cleaned_parameters['username'];
        $password = $cleaned_parameters['password'];

        $store_result_username = $session_wrapper->setSessionVar('user_name', $username);
        $store_result_password = $session_wrapper->setSessionVar('password', $password);

        if ($store_result_username !== false && $store_result_password !== false)	{
            $store_result = true;
        }
        return $store_result;
    }

    public function storeDataInDatabase(
        $container,
        $settings,
        $doctrine_queries,
        $cleaned_parameters
    ): string
    {
        $storage_result = [];
        $store_result = '';
        $sid = session_id();

        $database_connection_settings = $settings['doctrine_connection'];

        $database_connection = DriverManager::getConnection($database_connection_settings);
        $queryBuilder = $database_connection->createQueryBuilder();

        $session_var_name = 'username';
        $session_value = $cleaned_parameters['username'];
        $storage_result = $this->storeOneSessionValue($doctrine_queries, $queryBuilder, $sid, $session_var_name, $session_value);

        $session_var_name = 'password';
        $session_value = $cleaned_parameters['password'];
        $storage_result = $this->storeOneSessionValue($doctrine_queries, $queryBuilder, $sid, $session_var_name, $session_value);

        return $store_result;
    }

    private function storeOneSessionValue($doctrine_queries, $queryBuilder, $sid, $session_var_name, $session_value): array | string
    {
        $store_result = '';
        $storage_result = $doctrine_queries::queryStoreSession($queryBuilder, $sid, $session_var_name, $session_value);

        if ($storage_result['outcome'] == 1)
        {
            $store_result .= 'User data was successfully stored with the Doctrine ORM using the SQL query: ' . $storage_result['sql_query'];
        }
        else
        {
            $store_result .= 'There appears to have been a problem when saving your details.  Please try again later.';
        }
        return $store_result;
    }

    public function cleanupParameters($validator, $tainted_parameters): array
    {
        $cleaned_parameters = [];

        if (isset($tainted_parameters['password'])) {
            $cleaned_parameters['password']  = $tainted_parameters['password'];
        }
        else{
            $cleaned_parameters['password'] = false;
        }

        if (isset($tainted_parameters['username'])) {
            $tainted_username = $tainted_parameters['username'];
            $validated_username = $validator->sanitiseString($tainted_username);
        }

        if ($validated_username) {
            $cleaned_parameters['username'] = $validated_username;
        }
        else{
            $cleaned_parameters['username'] = false;
        }

        if (isset($tainted_parameters['server_type'])) {
            $tainted_server_type = $tainted_parameters['server_type'];
            $validated_server_type = $validator->validateServerType($tainted_server_type);
        }

        if ($validated_server_type) {
            $cleaned_parameters['server_type'] = $validated_server_type;
        }
        else{
            $cleaned_parameters['server_type'] = false;

        }
        return $cleaned_parameters;
    }

}
