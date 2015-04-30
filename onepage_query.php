<?php
// List dbs
	$dir = "upload/";
	$item = (glob($dir . "*.db"));

	echo '<form name="interface" method="post"  onsubmit="checkSearch();return false;">
		<select name="qdb" class="optext" title="op"/>';
	
	foreach ($item as $i){
		list($folder, $dbname) = split('[/]', $i);
		echo '<option value="' . $dbname. '">' . $dbname . '</option>';
	}

	echo '</select>';


//List tables
	class MyDB extends SQLite3
	{
    		function __construct($str)
   		{
        		$this->open($str);
    		}
	}

	$db = new MyDB("upload/AliceFinal.db");
	
	echo '      	<select name="qtable" class="optext" title="op"/>';
        
	$tableName = array();
	$result = $db->query('SELECT name FROM sqlite_master where type = \'table\'');
	$tableNum = 0;
	while ($row = $result->fetchArray(SQLITE3_NUM))
	{
		$tableName[$tableNum] = $row[0];
		echo '<option value="'. $tableName[$tableNum].'">'. $tableName[$tableNum]. '</optiont>';
		$tableNum++;
	}

//	$table = array();	
	// Create or read tables
 //       for($i = 0; $i < $tableNum; $i++){
  //             	$table[$i]->exec('CREATE TABLE '.$tableName[$i].' (Id INTEGER PRIMARY KEY, Organism TEXT, DairyLagoon TEXT, Freq_DL TEXT)');
  //      	}
	
	echo '</select>';

?>
<?php
	// input bacterial
	echo 'Bacterial name:
		<input type="qt" name="qt">
      	 	<input type="submit"></form>';


	$qdb =$_POST['qdb'];
	$qtable = $_POST['qtable'];
	echo $qdb;
//	$db = new MyDB("upload/AliceFinal.db);
	
//	for($i = 0; $i < $tableNum; $i++){
 //               $db->exec('CREATE TABLE '.$str[$i].' (Id INTEGER PRIMARY KEY, Bacterial TEXT, Counter TEXT, Freq TEXT)');
//	}


	echo "You are looking for: ".$_POST['qt']."  from table: ". $_POST['qtable']."  in Database: " .$_POST['qdb'];
	if ( preg_match('/\%/' , $_POST['qt']) ){
        	$result = $db->query('SELECT * FROM '. $_POST['qtable']. ' WHERE Bacterial LIKE \'' . $_POST['qt']. '\'');
}
	else
        	$result = $db->query('SELECT * FROM '. $_POST['qtable']. ' WHERE Bacterial= \'' . $_POST['qt']. '\'');

	$row = array();

	print "<table border=1>";
	print "<tr><td>Id</td><td>Bacterial Name</td><td>Counter</td><td>Freq</td></tr>";

	$i = 0;
        while($row = $result->fetchArray(SQLITE3_BOTH)){
        	echo "<tr>";
    		echo "<td>".$row['Id']."</td>";
   	 	echo "<td>".$row['Bacterial']."</td>";
       	 	echo "<td>".$row['Counter']."</td>";
       	 	echo "<td>".$row['Freq']."</td>";
        	echo "</tr>";
        }

         print_r($row);




?>

