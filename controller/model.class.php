<?php

class Model
{
    // Refer to database connection
    private $db;

    // Instantiate object with database connection
    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }
    public function select_all($tablename)
    {
        try {
            // Define query to insert values into the users table
            $sql = "SELECT * FROM " . $tablename . "";

            // Prepare the statement
            $query = $this->db->prepare($sql);

            // Bind parameters

            // Execute the query
            $query->execute();

            // Return row as an array indexed by both column name
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }




    public function select_where($whrtablename, $columna, $conditiona,  $columnb, $conditionb)
    {
        try {
            // Define query to insert values into the users table
            $sql = "SELECT * FROM " . $whrtablename . " WHERE " . $columna . " = :conditiona AND  " . $columnb . " = :conditionb ";

            // Prepare the statement
            $query = $this->db->prepare($sql);

            // Bind parameters
            $query->bindParam(":conditiona", $conditiona);
            $query->bindParam(":conditionb", $conditionb);
            // Execute the query
            $query->execute();

            // Return row as an array indexed by both column name
            $rows = $query->fetch(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
    public function insert_data($table, $data)
    {
        if (!empty($data) && is_array($data)) {
            $columns = '';
            $values  = '';
            $i = 0;


            $columnString = implode(',', array_keys($data));
            $valueString = ":" . implode(',:', array_keys($data));
            $sql = "INSERT INTO " . $table . " (" . $columnString . ") VALUES (" . $valueString . ")";
            $query = $this->db->prepare($sql);
            foreach ($data as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
            $insert = $query->execute();
            return $insert ? $this->db->lastInsertId() : false;
        } else {
            return false;
        }
    }

    public function getRows($table, $conditions = array())
    {
        $sql = "SELECT ";
        $sql .= !empty($conditions['select']) ? $conditions['select'] : "*";
        $sql .= " FROM {$table}";

        $whereClauses = array();
        $values = array();

        // Handle = conditions
        if (!empty($conditions['where'])) {
            foreach ($conditions['where'] as $key => $value) {
                $whereClauses[] = "{$key} = ?";
                $values[] = $value;
            }
        }

        // Handle >= conditions
        if (!empty($conditions['where_greater_equals'])) {
            foreach ($conditions['where_greater_equals'] as $key => $value) {
                $whereClauses[] = "{$key} >= ?";
                $values[] = $value;
            }
        }

        // Handle <= conditions
        if (!empty($conditions['where_lesser_equals'])) {
            foreach ($conditions['where_lesser_equals'] as $key => $value) {
                $whereClauses[] = "{$key} <= ?";
                $values[] = $value;
            }
        }

        // Handle > conditions
        if (!empty($conditions['where_greater'])) {
            foreach ($conditions['where_greater'] as $key => $value) {
                $whereClauses[] = "{$key} > ?";
                $values[] = $value;
            }
        }

        // Handle < conditions
        if (!empty($conditions['where_lesser'])) {
            foreach ($conditions['where_lesser'] as $key => $value) {
                $whereClauses[] = "{$key} < ?";
                $values[] = $value;
            }
        }

        // Handle LIKE conditions
        if (!empty($conditions['where_like'])) {
            foreach ($conditions['where_like'] as $key => $value) {
                $whereClauses[] = "{$key} LIKE ?";
                $values[] = $value;
            }
        }

        // Combine WHERE
        if (!empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        } else {
            $sql .= " WHERE 1=1";
        }

        // Extra raw SQL (for OR, IN, etc.)
        if (!empty($conditions['extra'])) {
            $sql .= " " . $conditions['extra'];
        }

        // Order By
        if (!empty($conditions['order_by'])) {
            $sql .= " ORDER BY " . $conditions['order_by'];
        }

        // Limit + Offset
        if (isset($conditions['limit'])) {
            $sql .= " LIMIT " . (int)$conditions['limit'];
        }
        if (isset($conditions['start'])) {
            $sql .= " OFFSET " . (int)$conditions['start'];
        }

        if (!empty($conditions['group_by'])) {
            $sql .= " GROUP BY " . $conditions['group_by'];
        }


        // Debug (optional)
        // echo $sql; print_r($values);

        $query = $this->db->prepare($sql);
        $query->execute($values);

        // Return type
        if (!empty($conditions['return_type'])) {
            switch ($conditions['return_type']) {
                case 'count':
                    return $query->rowCount();
                case 'single':
                    return $query->fetch(PDO::FETCH_ASSOC);
                default:
                    return $query->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }



    public function countRows($table, $conditions = array())
    {
        $sql = "SELECT COUNT(*) as count FROM {$table}";
        $values = array();

        if (!empty($conditions['where'])) {
            $whereClauses = array();
            foreach ($conditions['where'] as $key => $value) {
                if (stripos($key, 'LIKE') !== false) {
                    $col = trim(str_replace("LIKE", "", $key));
                    $whereClauses[] = "{$col} LIKE ?";
                    $values[] = $value;
                } else {
                    $whereClauses[] = "{$key} = ?";
                    $values[] = $value;
                }
            }
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        } else {
            $sql .= " WHERE 1=1";
        }

        if (!empty($conditions['extra'])) {
            $sql .= " " . $conditions['extra'];
        }

        $query = $this->db->prepare($sql);
        $query->execute($values);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['count'] : 0;
    }

    public function upDate($table, $data, $conditions)
    {
        if (!empty($data) && is_array($data)) {
            $colvalSet = '';
            $whereSql = '';
            $i = 0;

            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $colvalSet .= $pre . $key . "='" . $val . "'";
                $i++;
            }
            if (!empty($conditions) && is_array($conditions)) {
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach ($conditions as $key => $value) {
                    $pre = ($i > 0) ? ' AND ' : '';
                    $whereSql .= $pre . $key . " = '" . $value . "'";
                    $i++;
                }
            }
            $sql = "UPDATE " . $table . " SET " . $colvalSet . $whereSql;
            $query = $this->db->prepare($sql);
            $update = $query->execute();
            return $update ? $query->rowCount() : false;
        } else {
            return false;
        }
    }

    /* 
     * Delete data from the database 
     * @param string name of the table 
     * @param array where condition on deleting data 
     */
    public function delete($table, $condition = "1=1")
    {
        $params = [];

        if (is_array($condition)) {
            $whereParts = [];
            foreach ($condition as $key => $value) {
                $paramKey = ":where_" . $key;
                $whereParts[] = "$key = $paramKey";
                $params[$paramKey] = $value; // bind value later
            }
            $conditionSql = implode(" AND ", $whereParts);
        } else {
            $conditionSql = $condition; // raw string condition
        }

        $sql = "DELETE FROM {$table} WHERE {$conditionSql}";
        $stmt = $this->db->prepare($sql);

        foreach ($params as $param => $val) {
            $stmt->bindValue($param, $val);
        }

        return $stmt->execute();
    }
}
