<?php
$con = mysqli_connect('localhost','root','','apsi');
if (isset($_GET['input'])) {
    $input = $_GET['input'];
$query = mysqli_query($con,"SELECT * FROM barang WHERE nama LIKE '%$input%'"); //query mencari hasil search
if ($query === FALSE) {
    die(mysqli_error());
}
$hasil = mysqli_num_rows($query);
if ($hasil > 0)
{
    while ($data = mysqli_fetch_row($query)) {
        ?>
        <a href="javascript:autoInsert('<?=$data[0]?>','<?=$data[1]?>','<?=$data[5]?>');"><?=$data[1]?><br> <!--- hasil -->
            <?php
        }    
    }    
}    
?>