<?php session_start();?>
<?php if (!empty($result)): ?>
  <?php foreach ($result as $key => $value): ?>
    <tr>
        <td><?php echo $key + 1 ?></td>
        <td><?php echo $value["keterangan"] ?></td>
        <td><?php echo $value["kasus"] ?></td>
        <td><?php echo $value["tindakan"] ?></td>
        <td><?php echo date_format(date_create($value["date_start"]), "d-m-Y") ?></td>
        <td><?php echo date_format(date_create($value["date_end"]), "d-m-Y") ?></td>
        <td>
            <a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook('api/upload/data/<?php echo $value["url"] ?>')">
              <i class="fa fa-eye"></i>
            </a>
        </td>
    </tr>
  <?php endforeach ?>
<?php endif ?>