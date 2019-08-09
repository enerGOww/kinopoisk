<?php
use common\essence\Comment;
/* @var $model common\essence\Comment */
?>
<ul>
    <?php
    foreach ($model->comments as $item) {
        echo $this->render('/comment\comentsview', ['model' => $item, 'userId' => $userId]);
        echo  $this->render('/comment\commentTree', ['model' => $item, 'userId' => $userId]);
    }
    ?>
</ul>
