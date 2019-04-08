<?php session_start();?>
<?php if (!empty($result)): ?>
  <?php foreach ($result as $key => $value): ?>
    <tr>
        <td><?php echo $key + 1 ?></td>
        <td><?php echo $value["noktr"] ?></td>
        <td><?php echo date_format(date_create($value["tmtawal"]), "d-m-Y") ?></td>
        <td><?php echo date_format(date_create($value["tglktr"]), "d-m-Y") ?></td>
        <td><?php echo $value["jnsktr"] ?></td>
        <td><?php echo date_format(date_create($value["tglakhir"]), "d-m-Y") ?></td>
        <td>
            <a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook('api/upload/data/<?php echo $value["url"] ?>')">
              <i class="fa fa-eye"></i>
            </a>
			<?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
            <a class="btn btn-default" href="javascript:void(0);" onclick="hapusfile('<?php echo $value["id"] ?>')">
              <i class="fa fa-trash"></i>
            </a>
			<?php }?>
        </td>
    </tr>
  <?php endforeach ?>
<?php endif ?>