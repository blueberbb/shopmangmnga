
<div class="text-center" >
    
        <h4 > แสดงความคิดเห็นต่อสินค้า </h4>
<br>
                <form action="comment_save.php" method="post" class="from-horizontal">
                    <textarea name="c_datail" class="form-control" cols="30" rows="2"  required style="width: 100%;"></textarea>
                    <br>
                    <input type="hidden" name="ref_p_id" value="<?php echo $row['p_id']; ?>">
                    <button type="submit" class="btn"> แสดงความคิดเห็น <i class="fal fa-comment-alt-dots "></i></button>
                </form>
                </p>
                <p>
                <h4>รายการแสดงความคิดเห็นต่อสินค้า</h4>
                <?php
                include('./comment_list.php');
                ?>
                </p>
        </div>
  
