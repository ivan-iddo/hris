<?php foreach($navigation as $keys => $values){ ?>
        <?php if(count($values['children']) > 0) { ?>
        <li>
            <a href="<?php echo $values['NAVIGATION_LINK']; ?>" class="dropdown-toggle">
                <i class="<?php echo $values['NAVIGATION_CLS']; ?>"></i>
                <span class="menu-text"> <?php echo $values['NAVIGATION_NAME']; ?> </span>

                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                
                <?php foreach($values['children'] as $ck => $child) { ?>
                <li class="<?php if($this->uri->segment(1)==strtolower($child['NAVIGATION_NAME'])){echo "active";}?>">
                        <a href="<?php echo $child['NAVIGATION_LINK']; ?>">
                            <i class="icon-double-angle-right"></i>
                            <?php echo $child['NAVIGATION_NAME']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
        <?php } else { ?>
            <li class="<?php if($this->uri->segment(1)=="search"){echo "active";}?>">
                <a href="<?php echo $values['NAVIGATION_LINK']; ?>">
                    <i class="<?php echo $values['NAVIGATION_CLS']; ?>"></i>
                    <span class="menu-text"> <?php echo $values['NAVIGATION_NAME']?> </span>
                </a>
            </li>
        <?php } ?>
<?php } ?>

