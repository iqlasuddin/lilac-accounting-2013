<?php
ob_start();
include('elements/connect.php');
check_login();

    $step=0;
    //$link = mysql_connect($host,$user,$pass);
    //mysql_select_db($dbname,$link);
    
    //get all of the tables
    //if($tables == '*')
    //{
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while ($row = mysql_fetch_row($result)) {
            $tables[] = $row[0];
        }
    //}
    //else
    //{
    //	$tables = is_array($tables) ? $tables : explode(',',$tables);
    //}
    $return='';
    //cycle through
    foreach ($tables as $table) {
        $result = mysql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);
        
        
        //$return.= 'DROP TABLE '.$table.';';
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        
        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysql_fetch_row($result)) {
                $return.= 'INSERT INTO `'.$table.'` VALUES(';
                for ($j=0; $j<$num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    //$row[$j] = preg_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) {
                        $return.= '"'.$row[$j].'"' ;
                    } else {
                        $return.= '""';
                    }
                    if ($j<($num_fields-1)) {
                        $return.= ',';
                    }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }
    
    //save file
    $bkup_filename='dbackup_dumps/db-iqsuite-backup-'.time().'-'.'.sql';
    $handle = fopen($bkup_filename, 'w+');
    fwrite($handle, $return);
    fclose($handle);
    header("location:admin-tasks?id=".urlencode($bkup_filename)."");
