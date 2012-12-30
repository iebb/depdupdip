<?php
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');

		$sql="SELECT * 	FROM problem ORDER BY  `in_date` DESC LIMIT 0 , 5";

		$result = mysql_query ( $sql ); 
		while ( $row = mysql_fetch_object ( $result ) ) {
		    echo 
'
<tr>
<td style="text-align:center">
	<a class="nounderline" href="/problem.php?id='.$row->problem_id.' ">
		<span class="label label-info">'.sprintf("P%04d",$row->problem_id).'</span>
	</a>
</td><td>
	<a href="/problem.php?id='.$row->problem_id.'">'.$row->title.'</a>
				<td>'.$row->in_date.'</td>
</td><td>'.$row->accepted.'</td><td>'.sprintf ( "%.02lf%%", 100 * $row->accepted / $row->submit ).'</td></tr>';
		}
		
		mysql_free_result ( $result );
?>
