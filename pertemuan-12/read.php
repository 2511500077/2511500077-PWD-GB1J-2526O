<?php
require 'koneksi.php';
require 'fungsi.php';

$sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
$q = mysqli_query($conn, $sql) ;
$no = 1;

?>

<table border="1" cellpadding="8" cellspacing="0">

<tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Pesan</th>
    <th>Created At</th>
</tr>


<?php while ($row = mysqli_fetch_assoc($q)): ?>
<tr>

    <td><?= $no++; ?></td>

    <td>
        <a href="edit.php?id=<?= $row['cid']; ?>">edit</a>
    </td>

    <td><?= $row['cid']; ?></td>
    <td><?= htmlspecialchars($row['cnama']); ?></td>
    <td><?= htmlspecialchars($row['cemail']); ?></td>
    <td><?= htmlspecialchars($row['cpesan']); ?></td>

    <td>
        <?= date('d M Y H:i:s', strtotime($row['created_at'])); ?>
    </td>
</tr>
<?php endwhile; ?>
</table>