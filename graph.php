<?php
    $dbhost="localhost";
    $dblogin="testuser";
    $dbpwd="test623";
    $dbname="testdb";
       
    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
    mysql_select_db($dbname);    
	    
#    $SQLString = "select str_to_date(substr(edate,1,8),'%d.%m.%y') as wdate,
#                  weight
#                  from weight order by wdate asc";

    $SQLString = "select weekofyear(str_to_date(substr(edate,1,9),'%d.%m.%y')) as wdate ,
    avg(weight)as weight 
    from weight group by wdate";

								
    $result = mysql_query($SQLString);    
    $num = mysql_num_rows($result);   

# set heading	
    $data[0] = array('datum','gewicht');		
    for ($i=1; $i<($num+1); $i++)
    {
        $data[$i] = array(date(mysql_result($result, $i-1, "wdate")),
			(float) mysql_result($result, $i-1, "weight"));
    }	
    echo json_encode($data);
    mysql_close($db);
?>
