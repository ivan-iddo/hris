<?php if (!empty($result)): ?>
  <?php foreach ($result as $key => $value): ?>
    <tr>
        <td><?php echo $key + 1 ?></td>
        <td><?php echo $value["noktr"] ?></td>
        <td><?php echo $value["tmtawal"] ?></td>
        <td><?php echo $value["tglktr"] ?></td>
        <td><?php echo $value["jnsktr"] ?></td>
        <td><?php echo $value["tglakhir"] ?></td>
        <td>
            <a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook('api/upload/data/<?php echo $value["url"] ?>')">
              <i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-default" href="javascript:void(0);" onclick="hapusfile('<?php echo $value["id"] ?>')">
              <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
  <?php endforeach ?>
<?php endif ?>