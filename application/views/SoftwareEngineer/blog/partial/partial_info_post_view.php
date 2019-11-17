<?php
//echo 'info partial from:' . $callerPage;
$ulClass = '';
if ($callerPage == 'list-posts') $ulClass = 'info';
if ($callerPage == 'show-post') $ulClass = 'info-post';
?>

<ul class="<?= $ulClass ?>">
    <li title="Created: <?= substr($post->createDate, 0, 19) ?>"><i class="glyphicon glyphicon-time"></i>&nbsp; Created: <?= substr($post->createDate, 0, 10) ?></li>
    <li title="Last Edited: <?= substr($post->lastModifiedDate, 0, 19) ?>"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Last Edited: <?= substr($post->lastModifiedDate, 0, 10) ?></li>
    <li><i class="glyphicon glyphicon-th-list"></i>&nbsp; Category: <a href="<?= $post->category->link ?>"><?= $post->category->name ?></a></li>
    <li><i class="glyphicon glyphicon-user"></i>&nbsp; Seen: <?= $post->seenCount ?> time<?= $post->seenCount == 1 ? '' : 's' ?></li>
    <li><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp; Liked: <?= $post->likedCount ?> time<?= $post->likedCount == 1 ? '' : 's' ?></li>
    <li><i class="glyphicon glyphicon-comment"></i>&nbsp; Comments: <?= count($post->comments) ?></li>
    <?php if (count($post->tags) > 0) { ?>
        <li><i class="glyphicon glyphicon-tag"></i>&nbsp; Tags: <?= implode(", ", $post->tags) ?></li>
    <?php } ?>
</ul>