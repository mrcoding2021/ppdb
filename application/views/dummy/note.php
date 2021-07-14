<?php $no = 0;
foreach ($users as $key) : ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $key->date_created ?></td>
        <td><?= $key->nama ?></td>
        <td><?= $key->kelas ?></td>
        <td><?= rupiah($key->spp) ?></td>
        <td>
            <a href="#" class="btn btn-success btn-border-circle  btn-sm">
                Edit</a>
            <a href="#" class="btn btn-danger btn-border-circle  btn-sm">
                Hapus</a>
        </td>
    </tr>
<?php endforeach ?> </tbody>