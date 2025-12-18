<?php
require 'koneksi.php';

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
    <!-- No -->
    <td><?= $no++; ?></td>

    <!-- Aksi -->
    <td>
        <a href="edit.php?id=<?= $row['cid']; ?>">edit</a>
    </td>

    <!-- ID -->
    <td><?= $row['cid']; ?></td>

    <!-- Nama -->
    <td><?= htmlspecialchars($row['cnama']); ?></td>

    <!-- Email -->
    <td><?= htmlspecialchars($row['cemail']); ?></td>

    <!-- Pesan -->
    <td><?= htmlspecialchars($row['cpesan']); ?></td>

    <!-- Created At -->
    <td>
        <?= date('d M Y H:i:s', strtotime($row['created_at'])); ?>
    </td>
</tr>
<?php endwhile; ?>
</table>