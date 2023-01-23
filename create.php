<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL; 
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $kode_film = isset($_POST['kode_film']) ? $_POST['kode_film'] : '';
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $th_rilis = isset($_POST['th_rilis']) ? $_POST['th_rilis'] : '';
    

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_film VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $kode_film, $judul, $th_rilis]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Film</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="kode_film">Kode Film</label>
        <input type="text" name="id" id="id">
        <input type="text" name="kode_film" id="kode_film">
        <label for="judul">Judul</label>
        <label for="th_rilis">Tahun Rilis</label>
        <input type="text" name="judul" id="judul">
        <input type="text" name="th_rilis" id="th_rilis">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>