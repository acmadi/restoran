<html>
<style>
html,body{margin:0;padding:0}
table{font-size:18px;border-collapse:collapse}
table th {border:1px solid #000}
</style>
<body>
<table border="0" style="width:200px">
<?php
foreach($wishlist as $k => $v) {
$wname=$v -> wname;
$wstatus=$v -> wstatus;
$wtid=$wtid;
$tname=$v -> tname;
$person=$v -> person;
$notes=$v -> wnotes;
$note=$v -> wnote;
}
$wcount= count($wishlist);
if($wcount==0){
$wname="";
$wstatus="";
$tname="";
$person="";
$notes="";
$note="";
}
?>
<tr><td>Meja</td><td>: <?php echo $tname; ?></td></tr>
<tr><td>Nama</td><td>: <?php echo $wname; ?></td></tr>
<tr><td>Person</th><td>: <?php echo $person; ?></td></tr>
</table>
<br>

<table border="0" style="width:400px">
<thead>
<tr>
<th>No. </th>		  
<th>Menu</th>		  
<th>Qty</th>
<th>Notes</th>
</tr>
</thead>
<tbody>
<?php
$t=0;
$i=1;
foreach($wishlist as $k => $v) :
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $v -> mname; ?></td>
<td> <?php echo $v -> wqty;?></td>
<td><?php echo $v->wnote; ?></td>
</tr>
<?php
++$i;
$t=$t+$v -> wqty;
endforeach; ?>

</tbody>
<tr><td></td><td>Total </td><td><?=$t;?></td><td></td></tr>
</table>	
</body>
</html>