<?php
include 'elements/connect.php';
$query_cat=mysql_query("select * from tblcategory");
// echo '<select class="input-xlarge" id="selectCategory" data-rel="chosen" name="itemcategory">
// <option  value="">...Select Category...</option>';
$ping=$_POST['ping'];
$count=0;
                                    while ($cats=mysql_fetch_array($query_cat)) {
                                        ?>
										<li id="selectCategory_chzn_o_<?php echo $count;
                                        $count=$count+1; ?>" class="active-result" ><?php echo $cats['c_name']; ?></li>
								<?php
                                    }
// echo ' </select>';
 ?>
