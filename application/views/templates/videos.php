<!-- Display uploaded videos -->
<div id="wrap" style="width:1200px; margin: 0px auto;" >
    <h3>Videos<span id="text" style="display: none;"><?php echo count($files) - 9?></span></h3>

    <?php $length = 9; $res = array(0,1,2,3,4);
    if(!empty($files)){ if(count($files) <= 9){for($i = 0; $i < count($files); $i++){ ?>
        <li>
            <a href="<?php echo base_url(); ?>users/play_video/<?php echo $files[$i]['id']; ?>" style="font-size: xx-large;">
                <?php echo $files[$i]['video_name']; ?>
            </a>
        </li>
    <?php }?><?php }else{for($i = 0; $i < count($files); $i++) {?>
        <li>
            <a href="<?php echo base_url(); ?>users/play_video/<?php echo $files[$i]['id']; ?>" style="font-size: xx-large;">
                <?php echo $files[$i]['video_name']; ?>
            </a>
        </li>
    <?php }}}else{ ?>
        <p>Don't have any videos</p>
    <?php } ?>
</div>
