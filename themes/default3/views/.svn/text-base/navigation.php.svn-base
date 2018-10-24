<?php foreach($navigation as $keys => $values){ ?>
        <?php if(count($values['children']) > 0) { ?>
        <li class="treeview">
            <a href="<?php echo $values['NAVIGATION_LINK']; ?>" >
                <i class="<?php echo $values['NAVIGATION_CLS']; ?>"></i>
                <span><?php echo $values['NAVIGATION_NAME']; ?></span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">                
                <?php foreach($values['children'] as $ck => $child) { ?>
                <li>
                    <a href="<?php echo $child['NAVIGATION_LINK']; ?>">
                        <i class="fa fa-circle-o"></i><?php echo $child['NAVIGATION_NAME']; ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </li>
        <?php } else { ?>
            <li>
                <a href="<?php echo $values['NAVIGATION_LINK']; ?>">
                    <i class="<?php echo $values['NAVIGATION_CLS']; ?>"></i>
                    <span><?php echo $values['NAVIGATION_NAME']?></span>
                </a>
            </li>
        <?php } ?>
<?php } ?>

