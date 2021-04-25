<?php

namespace DB {

    use \mysqli;

    class DBcontext
    {

        protected $connection;
        protected $query;
        protected $show_errors = TRUE;
        protected $query_closed = TRUE;
        public $query_count = 0;

        function __construct($dbhost = DBCONFIG["SERVER_NAME"], $dbuser = DBCONFIG["SERVER_USER_NAME"], $dbpass = DBCONFIG["SERVER_PASSWORD"], $dbname = DBCONFIG["DATABASE_NAME"], $charset = 'utf8')
        {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if ($this->connection->connect_error) {
                $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
            }
            $this->connection->set_charset($charset);
        }

        function query($query)
        {
            if (!$this->query_closed) {
                $this->query->close();
            }
            if ($this->query = $this->connection->prepare($query)) {
                if (func_num_args() > 1) {
                    $x = func_get_args();
                    $args = array_slice($x, 1);
                    $types = '';
                    $args_ref = array();
                    foreach ($args as $k => &$arg) {
                        if (is_array($args[$k])) {
                            foreach ($args[$k] as $j => &$a) {
                                $types .= $this->_gettype($args[$k][$j]);
                                $args_ref[] = &$a;
                            }
                        } else {
                            $types .= $this->_gettype($args[$k]);
                            $args_ref[] = &$arg;
                        }
                    }
                    array_unshift($args_ref, $types);
                    call_user_func_array(array($this->query, 'bind_param'), $args_ref);
                }
                $this->query->execute();
                if ($this->query->errno) {
                    $this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
                }
                $this->query_closed = FALSE;
                $this->query_count++;
            } else {
                $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
            }
            return $this;
        }


        function fetchAll($callback = null)
        {
            $params = array();
            $row = array();
            $meta = $this->query->result_metadata();
            while ($field = $meta->fetch_field()) {
                $params[] = &$row[$field->name];
            }
            call_user_func_array(array($this->query, 'bind_result'), $params);
            $result = array();
            while ($this->query->fetch()) {
                $r = array();
                foreach ($row as $key => $val) {
                    $r[$key] = $val;
                }
                if ($callback != null && is_callable($callback)) {
                    $value = call_user_func($callback, $r);
                    if ($value == 'break') break;
                } else {
                    $result[] = $r;
                }
            }
            $this->query->close();
            $this->query_closed = TRUE;
            return $result;
        }

        function fetchArray()
        {
            $params = array();
            $row = array();
            $meta = $this->query->result_metadata();
            while ($field = $meta->fetch_field()) {
                $params[] = &$row[$field->name];
            }
            call_user_func_array(array($this->query, 'bind_result'), $params);
            $result = array();
            while ($this->query->fetch()) {
                foreach ($row as $key => $val) {
                    $result[$key] = $val;
                }
            }
            $this->query->close();
            $this->query_closed = TRUE;
            return $result;
        }

        function close()
        {
            return $this->connection->close();
        }

        function numRows()
        {
            $this->query->store_result();
            return $this->query->num_rows;
        }

        function affectedRows()
        {
            return $this->query->affected_rows;
        }

        function lastInsertID()
        {
            return $this->connection->insert_id;
        }

        function error($error)
        {
            if ($this->show_errors) {
                exit("<p class='text-center'>$error<p class='text-center'>");
            }
        }

        private function _gettype($var)
        {
            if (is_string($var)) return 's';
            if (is_float($var)) return 'd';
            if (is_int($var)) return 'i';
            return 'b';
        }
    }
}
