<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $kode_pem = isset($_POST['kode_pem']) ? $_POST['kode_pem'] : '';
        $nama= isset($_POST['nama']) ? $_POST['nama'] : '';
        $tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
        $pria= isset($_POST['pria']) ? $_POST['pria'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_pemain SET id = ?, kode_pemain = ?, nama = ?, tgl_lahir = ?, pria = ? WHERE id = ?');
        $stmt->execute([$id, $kode_pemain, $nama, $tgl_lahir, $pria, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_pemain WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $pemain = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$pemain) {
        exit('pemain doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Pemain #<?=$pemain['id']?></h2>
    <form action="update1.php?id=<?=$pemain['id']?>" method="post">
        <label for="id">ID</label>
        <label for="kode_pemain">kode Pemain</label>
        <input type="text" name="id" value="<?=$pemain['id']?>" id="id">
        <input type="text" name="kode_pemain" value="<?=$pemain['kode_pemain']?>" id="kode_pemain">
        <label for="nama">Nama</label>
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="text" name="nama" value="<?=$pemain['nama']?>" id="nama">
        <input type="text" name="tgl_lahir" value="<?=$pemain['tgl_lahir']?>" id="tgl_lahir">
        <label for="pria">Pria</label>
        <input type="text" name="pria" value="<?=$pemain['pria']?>" id="pria">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>