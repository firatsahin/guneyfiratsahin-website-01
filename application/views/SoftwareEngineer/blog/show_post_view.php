<?php $post = $blogData->post; ?>

<h1 class="h-bloc">Blog Post: <?= $post->title ?></h1>

<div>
    <a href="<?= SOFTWARE_ENGINEER_ROOT_URI . SOFTWARE_ENGINEER_BLOG_SUFFIX . (isset($_GET['from']) && $_GET['from'] ? $_GET['from'] : SOFTWARE_ENGINEER_BLOG_DEFAULT_PATH) ?>" class="readmore" style="float: unset;"><i class="glyphicon glyphicon-chevron-left"></i>&nbsp; Back to Post List</a>
</div>

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page">

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
                                                                <img src="<?= SOFTWARE_ENGINEER_ROOT_URI ?><?= $post->images[$i]->src ?>" alt="" />
                                                                <div class="carousel-caption">
                                                                    <h4><?= $post->images[$i]->label ?></h4>
                                                                    <p><?= $post->images[$i]->text ?></p>
                                                                </div>
                                                            </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                            <?php } else { // single image ?>

                                                <img src="<?= SOFTWARE_ENGINEER_ROOT_URI ?><?= $post->images[0]->src ?>" class="img-hover" alt="" />

                                            <?php } ?>

                                        </div>
                                    </div>
                                <?php } ?>

                            </div>

                            <div class="title_content">
                                <div class="text_content"><?= $blogData->post->title ?></div>
                                <div class="clear"></div>
                            </div>

                            <?php if (isset($post->contents) && is_array($post->contents) && count($post->contents) > 0) { ?>
                                <?php for ($i = 0; $i < count($post->contents); $i++) { ?>

                                    <?php if ($post->contents[$i]->contentTypeId == "1") { ?>
                                        <p <?= $i == 0 ? 'class="caps"' : '' ?>><?= $post->contents[$i]->content ?></p>
                                    <?php } ?>

                                <?php } ?>
                            <?php } else { ?>
                                <p>No content yet.</p>
                            <?php } ?>

                            <div class="col-md-12 first">
                                <div class="info">
                                    <div>
                                        <span class="tag">#php</span>
                                        <span class="tag">#web</span>
                                        <span class="tag">#web design</span>
                                    </div>


                                    <ul class="info-post">
                                        <li><i class="glyphicon glyphicon-comment"></i>&nbsp; 2 Comments</li>
                                        <li title="<?= $post->createDate ?>"><i class="glyphicon glyphicon-time"></i>&nbsp; <?= substr($post->createDate, 0, 10) ?></li>
                                        <li><i class="glyphicon glyphicon-user"></i>&nbsp; Seen: <?= $post->readCount ?> time<?= $post->readCount == 1 ? '' : 's' ?></li>
                                        <li><i class="glyphicon glyphicon-tag"></i>&nbsp; php, web design</li>
                                    </ul>
                                </div>

                                <div class="clear"></div>


                                <?php /*<div class="about_author">
                                    <div class="title_content" style="margin-bottom:10px">
                                        <div class="text_content">BILL GATES</div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>


                                    <div class="prg_content">
                                        <img src="https://placehold.it/100x100" width="100" height="100" alt="img">

                                        <div class="text">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Praesent condimentum sed elit
                                            vitae tristique. Aliquam erat volutpat. Nunc sit
                                            amet cursus libero. In fringilla egestas ornare.
                                        </div>

                                        <div class="nb_post" style="margin-top: 10px;">
                                            <b id="nb_post"> 15 posts</b> created by author
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>*/ ?>


                                <div class="post_comments">

                                    <div class="title_content">
                                        <div class="text_content">5 Comments</div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="comments">

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">John Doe <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">John Smith <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">Andrian Robert <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->



                                    </div><!-- .post_comments -->

                                    <div class="clear"></div>


                                    <div class="comment_form">

                                        <div class="title_content">
                                            <div class="text_content">Leave A Comment</div>
                                            <div class="clear"></div>
                                        </div>


                                        <form method="post" id="comment_form">
                                            <p class="form-group" id="contact-name">
                                                <label for="name">Your Name</label>
                                                <input type="text" name="name" class="form-control" id="inputSuccess" placeholder="Name*...">
                                            </p>
                                            <p class="form-group" id="contact-email">
                                                <label for="email">Your Email</label>
                                                <input type="text" name="email" class="form-control" id="inputSuccess" placeholder="Email*...">
                                            </p>

                                            <p class="form-group" id="contact-message">
                                                <label for="message">Your Message</label>
                                                <textarea name="message" cols="88" rows="6" class="form-control" id="inputError" placeholder="Your Comment..."></textarea>
                                            </p>
                                            <input type="reset" name="reset" value="CLEAR" class="reset">
                                            <!--<input type="submit" name="submit" value="Post Comment" class="submit">-->
                                            <button type="button" class="submit">Post Comment</button>
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