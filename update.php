<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $kode_film = isset($_POST['kode_film']) ? $_POST['kode_film'] : '';
        $judul= isset($_POST['judul']) ? $_POST['judul'] : '';
        $th_rilis = isset($_POST['th_rilis']) ? $_POST['th_rilis'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_film SET id = ?, kode_film = ?, judul = ?, th_rilis = ? WHERE id = ?');
        $stmt->execute([$id, $kode_film, $judul, $th_rilis, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_film WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$film) {
        exit('film doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Film #<?=$film['id']?></h2>
    <form action="update.php?id=<?=$film['id']?>" method="post">
        <label for="id">ID</label>
        <label for="kode_film">kode Film</label>
        <input type="text" name="id" value="<?=$film['id']?>" id="id">
        <input type="text" name="kode_film" value="<?=$film['kode_film']?>" id="kode_film">
        <label for="judul">Judul</label>
        <label for="th_rilis">Tahun Rilis</label>
        <input type="text" name="judul" value="<?=$film['judul']?>" id="judul">
        <input type="text" name="th_rilis" value="<?=$film['th_rilis']?>" id="th_rilis">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>