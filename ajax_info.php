
    <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">

<table class="table table-striped table-bordered"  style="font-size:11;">
    <thead>
        <tr>
            <th>#</th>
            <th>文件名</th>
	    <th>信息</th><th>时间</th><th>内存</th>
        </tr>
    </thead>
    <tbody>

<?php
$stat=array(4=>"Accepted",5=>"Pres. Error",0=>"Pending",6=>"Wrong Answer",2=>"Compiling",1=>"Pending ReJudge",3=>"ReJudging",7=>"Time Limit Exceeded",11=>"Compile Error",9=>"Output Limit Exceeded",8=>"Memory Limit Exceeded",10=>"Runtime Error");
$style=array(4=>"success",5=>"important",0=>"info",6=>"important",2=>"info",1=>"info",3=>"info",7=>"warning",11=>"default",9=>"warning",8=>"warning",10=>"inverse");

	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');

		$sql="SELECT * FROM result WHERE `solution_id`=".$_GET['sid'];
		$result = mysql_query ( $sql );  $i=0;

		while ( $row = mysql_fetch_object ( $result ) ) { $i++;
		    echo '<tr><td style="text-align:center">'.$i.'</td><td>'.$row->file.'</td><td><a class="nounderline"><span class="label label-'.$style[$row->info].'">'.$stat[$row->info].'</span></a></td><td>'.$row->time.'</td><td>'.sprintf("%.3f KB",$row->memory/1024).'</td></tr>';
		}
		
		mysql_free_result ( $result );
?>
   </tbody>
</table>
