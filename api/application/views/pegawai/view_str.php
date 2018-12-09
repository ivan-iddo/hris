<?php if (!empty($result)): ?>
  <?php foreach ($result as $key => $value): ?>
    <tr>
        <td><?php echo $key + 1 ?></td>
        <td><?php echo $value["str"] ?></td>
        <td><?php echo $value["date_start"] ?></td>
        <td><?php echo $value["date_end"] ?></td>
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