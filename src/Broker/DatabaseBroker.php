<?php

namespace Nstaeger\CmsPluginFramework\Broker;

interface DatabaseBroker
{
    /**
     * @param string $table Table name
     * @param array  $where A named array of WHERE clauses (in column => value pairs). Multiple clauses will be joined
     *                      with ANDs. Both $where columns and $where values should be "raw". Sending a null value will
     *                      create an IS NULL comparison - the corresponding format will be ignored in this case.
     * @return int|false The number of rows updated, or false on error.
     */
    function delete($table, array $where);

    /**
     * Perform a MySQL database query.
     *
     * @param string      $query    Query statement with sprintf()-like placeholders
     * @param array|mixed $args     The array of variables to substitute into the query's placeholders if being called
     *                              like
     *                              {@link http://php.net/vsprintf vsprintf()}, or the first variable to substitute
     *                              into the query's placeholders if being called like {@link http://php.net/sprintf
     *                              sprintf()}.
     * @param mixed       $args,... further variables to substitute into the query's placeholders if being called like
     *                              {@link http://php.net/sprintf sprintf()}.
     * @return int|false Number of rows affected/selected or false on error
     */
    function executePreparedQuery($query, $args);

    /**
     * Perform a MySQL database query.
     *
     * @param string $query Database query
     * @return int|false Number of rows affected/selected or false on error
     */
    function executeQuery($query);

    /**
     * Executes a SQL query and returns the entire SQL result.
     *
     * @param string $query SQL query.
     * @return array Database query results as associative array.
     */
    function fetchAll($query);

    /**
     * Insert a row into a table.
     *
     * @param string       $table  Table name
     * @param array        $data   Data to insert (in column => value pairs). Both $data columns and $data values
     *                             should be "raw" (neither should be SQL escaped). Sending a null value will cause the
     *                             column to be set to NULL - the corresponding format is ignored in this case.
     * @param array|string $format Optional. An array of formats to be mapped to each of the value in $data.
     *                             If string, that format will be used for all of the values in $data.
     *                             A format is one of '%d', '%f', '%s' (integer, float, string).
     *                             If omitted, all values in $data will be treated as strings unless otherwise
     *                             specified in wpdb::$field_types.
     * @return int|false The number of rows inserted, or false on error.
     */
    function insert($table, array $data, $format = null);

    /**
     * Update a row in the table
     *
     * update('table', array('column' => 'foo', 'field' => 'bar'), array('ID' => 1))
     * update('table', array('column' => 'foo', 'field' => 1337), array('ID' => 1), array('%s', '%d'), array('%d'))
     *
     * @param string       $table        Table name
     * @param array        $data         Data to update (in column => value pairs).
     *                                   Both $data columns and $data values should be "raw" (neither should be SQL
     *                                   escaped). Sending a null value will cause the column to be set to NULL - the
     *                                   corresponding format is ignored in this case.
     * @param array        $where        A named array of WHERE clauses (in column => value pairs).
     *                                   Multiple clauses will be joined with ANDs.
     *                                   Both $where columns and $where values should be "raw".
     *                                   Sending a null value will create an IS NULL comparison - the corresponding
     *                                   format will be ignored in this case.
     * @param array|string $format       Optional. An array of formats to be mapped to each of the values in $data.
     *                                   If string, that format will be used for all of the values in $data.
     *                                   A format is one of '%d', '%f', '%s' (integer, float, string).
     *                                   If omitted, all values in $data will be treated as strings unless otherwise
     *                                   specified in wpdb::$field_types.
     * @param array|string $where_format Optional. An array of formats to be mapped to each of the values in $where.
     *                                   If string, that format will be used for all of the items in $where.
     *                                   A format is one of '%d', '%f', '%s' (integer, float, string).
     *                                   If omitted, all values in $where will be treated as strings.
     * @return int|false The number of rows updated, or false on error.
     */
    function update($table, array $data, array $where, $format = null, $where_format = null);
}
