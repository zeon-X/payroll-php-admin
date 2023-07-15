$sql = "SELECT * FROM `employee`,`dept` " +
"WHERE"
+
$typetype_of_work != '' ? " `employee`.`type_of_work` = '$type_of_work' " : ""
+
"AND"
+
$dept_name != '' ? "`dept`.`dept_name` = '$dept_name' " : "" +
"AND"
+
"`dept`.`dept_location` = '$dept_location'";