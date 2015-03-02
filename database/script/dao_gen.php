<?php
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "Langara2";
$db_sche = "foodster";
$base_class = 'LotusyDaoParent';
$target_folder = '../../api/dao/generated/';

$conn = mysqli_connect("p:".$db_host, $db_user, $db_pass, $db_sche);
$sql = "SHOW TABLES";
$tableResult = $conn->query($sql);

while ($tableRow = $tableResult->fetch_array(MYSQLI_ASSOC)) {
    $table = reset($tableRow);

    $sql = "SHOW COLUMNS FROM $table";
    $result = $conn->query($sql);
    $fields = array();
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        array_push($fields, $row["Field"]);
    }

    $sql = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
    $primaryResult = $conn->query($sql);
    $primaryKeyArr = $primaryResult->fetch_array(MYSQLI_ASSOC);

    $class = to_camel_case($table).'DaoGenerated';
    $content = genParentClass($class, $table, $fields, $primaryKeyArr['Column_name']);

    file_put_contents($target_folder.$class.".php", $content);
}

function genParentClass($class, $table, $fields, $primaryKey) {
	global $base_class, $db_sche;

    $rv = "<?php".PHP_EOL;;
    $rv.= "abstract class $class extends $base_class {".PHP_EOL.PHP_EOL;

    $rv.= "    protected static \$table = '$table';".PHP_EOL.PHP_EOL;

    $rv.= "    protected function init() {".PHP_EOL;
    $rv.= "        \$this->var['id'] = 0;".PHP_EOL;
    foreach ($fields as $field) {
    	if ($field=='id') { continue; }
        $rv.= "        \$this->var['$field'] = null;".PHP_EOL;
    }
    $rv.= PHP_EOL;
    foreach ($fields as $field) {
        $rv.= "        \$this->update['$field'] = false;".PHP_EOL;
    }
    $rv.= "    }".PHP_EOL.PHP_EOL;

    foreach ($fields as $field) {
        if ($field!=$primaryKey) {
            $setter = "set".to_camel_case($field)."(\$$field)";
            $rv.= "    public function $setter {".PHP_EOL;
            $rv.= "        if (\$this->var['$field'] !== \$$field) {".PHP_EOL;
            $rv.= "            \$this->var['$field'] = \$".$field.";".PHP_EOL;
            $rv.= "            \$this->update['$field'] = true;".PHP_EOL;
            $rv.= "        }".PHP_EOL;
            $rv.= "    }".PHP_EOL;
        }
        $getter = "get".to_camel_case($field)."()";
        $rv.= "    public function $getter {".PHP_EOL;
        $rv.= "        return \$this->var['$field'];".PHP_EOL;
        $rv.= "    }".PHP_EOL.PHP_EOL;
    }

    $rv.= "    public function getTableName() {".PHP_EOL;
    $rv.= "        return self::\$table;".PHP_EOL;
    $rv.= "    }".PHP_EOL.PHP_EOL;
    $rv.= "    protected function getIdColumnName() {".PHP_EOL;
    $rv.= "        return '$primaryKey';".PHP_EOL;
    $rv.= "    }".PHP_EOL;
    $rv.= "}";

    return $rv;
}

function to_camel_case($str) {
	$str[0] = strtoupper($str[0]);
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $str);
}
