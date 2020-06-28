<?php $post = $blogData->post; ?>

<h1 class="h-bloc">Blog Post: <?= $post->title ?></h1>

<div>
    <a href="<?= (isset($_GET['from']) && $_GET['from']) ? $_GET['from'] : SOFTWARE_ENGINEER_ROOT_URI . SOFTWARE_ENGINEER_BLOG_SUFFIX  ?>" class="readmore" style="float: unset;"><i class="glyphicon glyphicon-chevron-left"></i>&nbsp; Back to Post List</a>
</div>

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page" blog-page-type="show-post">

            <!-- Page Blog - Post -->
            <section id="post-<?= $post->id ?>-page" class="content-post">
                <div class="row inner">

                    <div class="col-md-12" style="width: 100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;float: left;background: rgba(255, 255, 255, 0.8);padding-bottom: 15px;padding-top: 15px;">

                        <article class="postPage">

                            <div class="col-md-12 post_media">

                                <div class="post-format-icon">
                                    <span class="fa fa-<?= (isset($post->images) && is_array($post->images) && count($post->images) > 0) ? 'picture-o' : 'pencil' ?>"></span>
                                </div>

                                <?php if (isset($post->images) && is_array($post->images) && count($post->images) > 0) { // post has image(s) ?>
                                    <div class="media">
                                        <div class="he-wrap tpl2">

                                            <?php if (count($post->images) > 1) { // multiple images (slider) ?>

                                                <div id="carousel-<?= $post->id ?>" class="carousel slide" data-ride="carousel">

                                                    <ol class="carousel-indicators">
                                                        <?php for ($i = 0; $i < count($post->images); $i++) { ?>
                                                            <li data-target="#carousel-<?= $post->id ?>" data-slide-to="<?= $i ?>" <?= $i == 0 ? 'class="active"' : '' ?>></li>
                                                        <?php } ?>
                                                    </ol>

                                                    <div class="carousel-inner">

                                                        <?php for ($i = 0; $i < count($post->images); $i++) { ?>

                                                            <div class="item <?= $i == 0 ? 'active' : '' ?>">
                                                                <img src="<?= SOFTWARE_ENGINEER_BLOG_IMG_UPLOAD_PATH ?><?= $post->images[$i]->src ?>" class="postImg" alt="" />
                                                                <div class="carousel-caption">
                                                                    <h4><?= $post->images[$i]->label ?></h4>
                                                                    <p><?= $post->images[$i]->text ?></p>
                                                                </div>
                                                            </div>

                                                        <?php } ?>

                                                    </div>

                                                    <a class="left carousel-control" href="#carousel-<?= $post->id ?>" data-slide="prev" rel="nofollow">
                                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                                    </a>

                                                    <a class="right carousel-control" href="#carousel-<?= $post->id ?>" data-slide="next" rel="nofollow">
                                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                                    </a>

                                                </div>

                                            <?php } else { // single image ?>

                                                <img src="<?= SOFTWARE_ENGINEER_BLOG_IMG_UPLOAD_PATH ?><?= $post->images[0]->src ?>" class="img-hover" alt="" />

                                            <?php } ?>

                                        </div>
                                    </div>
                                <?php } ?>

                            </div>

                            <div class="title_content">
                                <div class="text_content"><?= $blogData->post->title ?></div>
                                <div class="clear"></div>
                            </div>

                            <div class="contents-wrapper">

                                <?php if (isset($post->contents) && is_array($post->contents) && count($post->contents) > 0) { ?>
                                    <?php for ($i = 0; $i < count($post->contents); $i++) { ?>

                                        <div content-id="<?= $post->contents[$i]->id ?>" content-type-id="<?= $post->contents[$i]->contentTypeId ?>">

                                            <?php if ($post->contents[$i]->contentTypeId == "1") { ?>

                                                <?php /*<p <?= $i == 0 ? 'class="caps"' : '' ?>><?= str_replace("\n", "<br />", $post->contents[$i]->content) ?></p>*/ ?>

                                                <?= str_replace("\n", "<br />", $post->contents[$i]->content) ?>

                                            <?php } ?>

                                            <?php if ($post->contents[$i]->contentTypeId == "2") {
                                                $jsonObj = json_decode($post->contents[$i]->content);
                                                if (!$jsonObj) $jsonObj = (object)[];
                                                ?>

                                                <?php if (isset($jsonObj->images) && is_array($jsonObj->images) && count($jsonObj->images) > 0) { ?>
                                                    <div name="image-slider-wrapper">
                                                        <?php foreach ($jsonObj->images as $index => $image) { ?>
                                                            <div name="image-slider-item">
                                                                <img lazy-src="<?= htmlspecialchars(SOFTWARE_ENGINEER_BLOG_IMG_UPLOAD_PATH . $image->url, ENT_QUOTES) ?>" alt="<?= isset($image->caption) && $image->caption ? $image->caption : '' ?>" />
                                                                <span name="image-slider-img-caption"><?= isset($image->caption) && $image->caption ? $image->caption : '&nbsp;' ?></span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>

                                            <?php } ?>

                                            <?php if ($post->contents[$i]->contentTypeId == "3") { ?>

                                                <pre><code><?= $post->contents[$i]->content ?></code></pre>

                                            <?php } ?>

                                            <?php if ($post->contents[$i]->contentTypeId == "4") {
                                                $jsonObj = json_decode($post->contents[$i]->content);
                                                if (!$jsonObj) $jsonObj = (object)[];
                                                if (isset($jsonObj->headerType) && $jsonObj->headerType && isset($jsonObj->headerText) && $jsonObj->headerText) echo '<' . $jsonObj->headerType . '>' . $jsonObj->headerText . '</' . $jsonObj->headerType . '>';
                                            } ?>

                                        </div>

                                    <?php } ?>
                                <?php } else { ?>
                                    <p>No content yet.</p>
                                <?php } ?>

                            </div>

                            <div class="col-md-12 first">
                                <div class="info">
                                    <div>

                                        <?php if (isset($post->tags) && is_array($post->tags)) { ?>
                                            <?php for ($i = 0; $i < count($post->tags); $i++) { ?>

                                                <span class="tag">#<?= $post->tags[$i] ?></span>

                                            <?php } ?>
                                        <?php } ?>

                                    </div>

                                    <div class="btn-like-post-div">
                                        <i class="glyphicon glyphicon-thumbs-up"></i>&nbsp; <span name="caption"> Post</span>
                                    </div>

                                    <div class="title_content">
                                        <div class="text_content">Stats</div>
                                        <div class="clear"></div>
                                    </div>

                                    <?php $this->load->view('SoftwareEngineer/blog/partial/partial_info_post_view', (object)["post" => $post, "callerPage" => "show-post"]); ?>
                                </div>

                                <div class="clear"></div>


                                <div class="post_comments">

                                    <div class="title_content">
                                        <div class="text_content"><?= count($post->comments) ?> Comment<?= count($post->comments) == 1 ? '' : 's' ?></div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="comments">

                                        <?php if (isset($post->comments) && is_array($post->comments) && count($post->comments) > 0) { ?>
                                            <?php for ($i = 0; $i < count($post->comments); $i++) { ?>

                                                <div class="comment">
                                                    <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                    <div class="text">
                                                        <div class="name"><?= $post->comments[$i]->commenterFullName ?></div>
                                                        <div class="date"><?= substr($post->comments[$i]->commentedDatetime, 0, 19) ?></div>
                                                        <div><?= $post->comments[$i]->commentText ?></div>
                                                    </div>

                                                    <?php if (isset($post->comments[$i]->replies) && is_array($post->comments[$i]->replies)) { ?>
                                                        <?php foreach ($post->comments[$i]->replies as $commentReply) { ?>

                                                            <div class="comment sub">
                                                                <img src="<?= SOFTWARE_ENGINEER_SITE_ROOT_URL ?>images/frt-images/frt_profile_pic.jpg" width="100" height="100" alt="img" />
                                                                <div class="text">
                                                                    <div class="name"><?= $data->personalInfo->name->global . ' ' . $data->personalInfo->surname->global ?></div>
                                                                    <div class="date"><?= substr($commentReply->commentedDatetime, 0, 19) ?></div>
                                                                    <div><?= $commentReply->commentText ?></div>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>

                                                        <?php } ?>
                                                    <?php } ?>
                                                    <div class="clear"></div>
                                                </div><!-- .comments -->

                                            <?php } ?>
                                        <?php } else { ?>
                                            <p style="margin-bottom: 10px;">No comments left to this post yet.</p>
                                        <?php } ?>

                                    </div><!-- .post_comments -->

                                    <div class="clear"></div>


                                    <div class="comment_form">

                                        <div class="title_content">
                                            <div class="text_content">Leave A Comment</div>
                                            <div class="clear"></div>
                                        </div>


                                        <form method="post" id="comment_form">
                                            <p class="form-group" column="commenterFullName">
                                                <label for="name">Your Name</label>
                                                <input type="text" name="commenterFullName" class="form-control" placeholder="Name*..." />
                                                <span class="error-messages">
                                                    <span error-type="required">&bull; Please enter your name.</span>
                                                </span>
                                            </p>
                                            <p class="form-group" column="commenterEmail">
                                                <label for="email">Your Email</label>
                                                <input type="text" name="commenterEmail" class="form-control" placeholder="Email*..." />
                                                <span class="error-messages">
                                                    <span error-type="required">&bull; Please enter your e-mail.</span>
                                                    <span error-type="invalid">&bull; Entered e-mail doesn't seem to be a valid one. Please fix.</span>
                                                </span>
                                            </p>

                                            <p class="form-group" column="commentText">
                                                <label for="message">Your Message</label>
                                                <textarea name="commentText" cols="88" rows="6" class="form-control" placeholder="Your Comment..."></textarea>
                                                <span class="error-messages">
                                                    <span error-type="required">&bull; Please enter your comment.</span>
                                                </span>
                                            </p>
                                            <div id="commentform-message"></div>
                                            <input type="reset" name="btnReset" value="CLEAR" class="reset">
                                            <!--<input type="submit" name="submit" value="Post Comment" class="submit">-->
                                            <button name="btnSubmit" class="submit">POST COMMENT</button>
                                        </form>
                                        <div class="clear"></div>

                                    </div>
                                </div>

                                <div class="col-md-12"  style="margin-top: 30px; padding: 0px;">

                                    <?php if ($blogData->prevLink) { ?>
                                        <a href="<?= $blogData->prevLink ?><?= isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '' ?>" class="readmore" style="float: left;"><i class="glyphicon glyphicon-chevron-left"></i>&nbsp; Previous Post</a>
                                    <?php } ?>

                                    <?php if ($blogData->nextLink) { ?>
                                        <a href="<?= $blogData->nextLink ?><?= isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '' ?>" class="readmore">Next Post &nbsp;<i class="glyphicon glyphicon-chevron-right"></i></a>
                                    <?php } ?>

                                </div>

                                <div class="clear"></div>

                        </article>
                    </div>
                    <div class="clear"></div>
                </div>
            </section>
            <!-- End Page Blog - Post -->

        </div>

    </div>
</div>