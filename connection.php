<style style="border: dashed;">
body {
	font-family: sans-serif;
}
table, th, td {
	border: 1px solid #ccc;
	border-collapse: collapse;
}
td {
	padding: 5px 10px;
}
</style>
<table>
<?php
$connect = mysqli_connect("localhost", "root", "root", "school");

if (!$connect) {
	die("Error: " . mysqli_connect_error());
}

$sql = "SELECT * FROM students";

if ($result = mysqli_query($connect, $sql)) {
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>$row[id]</td><td>$row[username]</td><td>$row[password]</td></tr>";
	}

	mysqli_free_result($result);
}?>
</table>
