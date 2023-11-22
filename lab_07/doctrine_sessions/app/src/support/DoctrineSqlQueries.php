<?php
/**
 * class to contain all database access using Doctrine's QueryBulder
 *
 * A QueryBuilder provides an API that is designed for conditionally constructing a DQL query in several steps.
 *
 * It provides a set of classes and methods that is able to programmatically build queries, and also provides
 * a fluent API.
 * This means that you can change between one methodology to the other as you want, or just pick a preferred one.
 *
 * From https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/query-builder.html
 */

namespace DoctrineSessions\Support;

class DoctrineSqlQueries
{
    public function __construct(){}

    public function __destruct(){}

    /**
     * stores a single session value in the database
     * @param object $queryBuilder
     * @param string $sid
     * @param string $session_var_name
     * @param string $session_value
     * @return array
     */
    public static function queryStoreSession(
        object $queryBuilder,
        string $sid,
        string $session_var_name,
        string $session_value
    )
    {
        $store_result = [];

        $qb = $queryBuilder->insert('session')
            ->values(
                [
                    'session_id' => ':sid',
                    'session_var_name' => ':session_var_name',
                    'session_value' => ':session_value'
                ]
            )->setParameters(
                [
                    'sid' => $sid,
                    'session_var_name' => $session_var_name,
                    'session_value' => $session_value
                ]
            );

        $store_result['outcome'] = $qb->execute();
        $store_result['sql_query'] = $qb->getSQL();

        return $store_result;
    }

    public static function queryRetrieveUserData($queryBuilder, string $local_session_id, string $session_var_name)
    {
        $retrieve_result = [];

        $queryBuilder
            ->select('session_value')
            ->from('session')
            ->where('local_session_id')
            ->and('session_var_name = :session_var_name')
            ->setParameter('local_session_id', $local_session_id)
            ->setParameter('session_var_name', $session_var_name)
            ->getQuery()
            ->getArrayResult();

        $query = $queryBuilder->execute();
        $result = $query->fetchAll();

        return $result;
    }
}
