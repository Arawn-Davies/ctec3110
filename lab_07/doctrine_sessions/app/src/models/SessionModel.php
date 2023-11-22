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

namespace DoctrineSessions\Models;

class SessionModel
{
  private string $username;
  private string $server_type;
  private string $password;
  private array $storage_result;
  private string $wrapper_session_file;
  private $wrapper_session_db;
  private object $db_handle;
  private $sql_queries;

  public function __construct()
  {
    $this->username = null;
    $this->server_type = null;
    $this->password = null;
    $this->storage_result = null;
    $this->wrapper_session_file = null;
    $this->wrapper_session_db = null;
    $this->db_handle = null;
    $this->sql_queries = null;
  }

  public function __destruct() { }

  public function setSessionValues(string $username, string $password): void
  {
    $this->username = $username;
    $this->password = $password;
  }

  public function setServerType($server_type): void
  {
    $this->server_type = $server_type;
  }

  public function setWrapperSessionFile($wrapper_session): void
  {
    $this->wrapper_session_file = $wrapper_session;
  }

  public function setWrapperSessionDb($wrapper_db): void
  {
    $this->wrapper_session_db = $wrapper_db;
  }

  public function setDbHandle(object $db_handle): void
  {
    $this->db_handle = $db_handle;
  }

  public function setSqlQueries($sql_queries)
  {
    $this->sql_queries = $sql_queries;
  }

  public function storeData()
  {
    switch ($this->server_type)	{
      case 'database':
        $this->storage_result['database'] = $this->storeDataInDatabase();
        break;
      case 'file':
      default:
        $this->storage_result['file'] = $this->storeDataInSessionFile();
    }
  }

  public function getStorageResult()
  {
    return $this->storage_result;
  }

  private function storeDataInSessionFile()
  {
    $store_result = false;
    $store_result_username = $this->wrapper_session_file->setSession('user_name', $this->username);
    $store_result_password = $this->wrapper_session_file->setSession('password', $this->password);

    if ($store_result_username !== false && $store_result_password !== false)	{
      $store_result = true;
    }
    return $store_result;
  }

  public function storeDataInDatabase()
  {
    $store_result = false;

    $this->wrapper_session_db->setDbHandle( $this->db_handle);
    $this->wrapper_session_db->setSqlQueries( $this->sql_queries);

    $store_result = $this->wrapper_session_db->storeSessionVar('user_name', $this->username);
    $store_result = $this->wrapper_session_db->storeSessionVar('user_password', $this->password);

    return $store_result;
  }
}
