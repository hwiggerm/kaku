 <?php


   $name = mysql_real_escape_string($_GET['d']);
   $output = shell_exec('/usr/bin/python /home/pi/kaku/t.py  '.$name.' 2>&1');

   $files = glob('images/wc/'.$name.'/*.*');

   for ($i=1; $i<count($files); $i++)

  {

  $image = $files[$i];

  print $image ."<br />";
  echo '<img src="'.$image .'" alt="Random image" />'."<br /><br />";
   }

 ?>
