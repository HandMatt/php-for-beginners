<?php

namespace Core;

use PDO;

/**
 * Database Connection and Query Handler
 * 
 * Provides database functionality:
 * - Manages PDO connection
 * - Executes prepared statements
 * - Fetches query results
 * - Handles common query patterns
 */
class Database
{
    /**
     * PDO connection instance
     * @var PDO
     */
    public $connection;

    /**
     * Current prepared statement
     * @var PDOStatement
     */
    public $statement;

    /**
     * Initialize database connection
     * 
     * @param array $config Database configuration
     * @param string $username Database username
     * @param string $password Database password
     */
    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    /**
     * Prepare and execute a SQL query
     * 
     * @param string $query SQL query string
     * @param array $params Query parameters
     * @return self
     */
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    /**
     * Fetch all results from the query
     * 
     * @return array Query results
     */
    public function get()
    {
        return $this->statement->fetchAll();
    }

    /**
     * Fetch single result from the query
     * 
     * @return array|false Single result or false
     */
    public function find()
    {
        return $this->statement->fetch();
    }

    /**
     * Fetch single result or abort
     * 
     * @return array Single result
     */
    public function findOrFail()
    {
        $result = $this->find();

        if (! $result) {
            abort();
        }

        return $result;
    }
}
