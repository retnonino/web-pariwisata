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
    $kode_pem = isset($_POST['kode_pem']) ? $_POST['kode_pem'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
    $pria = isset($_POST['pria']) ? $_POST['pria'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_pemain VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $kode_pem, $nama, $tgl_lahir, $pria]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Pemain</h2>
    <form action="create1.php" method="post">
        <label for="id">ID</label>
        <label for="kode_pem">Kode Pemain</label>
        <input type="text" name="id" id="id">
        <input type="text" name="kode_pem" id="kode_pem">
        <label for="nama">Nama</label>
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="text" name="nama" id="nama">
        <input type="text" name="tgl_lahir" id="tgl_lahir">
        <label for="pria">Pria</label>
        <input type="text" name="pria" id="pria">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>