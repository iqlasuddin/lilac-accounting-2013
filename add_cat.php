<?php
include 'elements/connect.php';
if (!empty($_POST['new_cat'])) {
    $new_cat=$_POST['new_cat'];
    $new_game = date('d/m/Y', time());
    $qurry="select * from tblcategory where c_name='$new_cat' ";
    $run_check=mysql_query($qurry);
    $check=mysql_num_rows($run_check);
    // $check=0;
    if ($check==0) {
        $query="insert into tblcategory (c_name,c_adddate) values ('$new_cat', '$new_game')";
        $insert_cat=mysql_query($query);
        if ($insert_cat) {
            echo mysql_insert_id();
        } else {
            echo "string";
        }
    } else {
        echo "string45";
    }
} else {
    echo "Fill The field";
}
