<?php $post = $blogData->post; ?>

<h1 class="h-bloc">Blog Post: <?= $post->postTitle ?></h1><br>

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
                                    <a href="#" class="item-date"><span class="fa fa-<?= (isset($post->images) && is_array($post->images) && count($post->images) > 0) ? 'picture-o' : 'pencil' ?>"></span></a>
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
                                <div class="text_content"><?= $blogData->post->postTitle ?></div>
                                <div class="clear"></div>
                            </div>

                            <?php if (isset($post->contents) && is_array($post->contents)) { ?>
                                <?php for ($i = 0; $i < count($post->contents); $i++) { ?>
                                    <p <?= $i == 0 ? 'class="caps"' : '' ?>><?= $post->contents[$i] ?></p>
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
                                        <li><i class="glyphicon glyphicon-comment"></i> 2 Comments</li>
                                        <li><i class="glyphicon glyphicon-time"></i> January 31, 2014</li>
                                        <li><i class="glyphicon glyphicon-user"></i> by Jane Doe</li>
                                        <li><i class="glyphicon glyphicon-tag"></i> php, web design</li>
                                    </ul>
                                </div>

                                <div class="clear"></div>


                                <div class="about_author">
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

                                <div class="clear"></div>


                                <div class="post_comments">

                                    <div class="title_content">
                                        <div class="text_content">7 Comments</div>
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
                                            <button class="submit" data-toggle="modal" data-target=".bs-example-modal-sm">Post Comment</button>
                                        </form>
                                        <div class="clear"></div>

                                    </div>
                                </div>

                                <div class="col-md-12"  style="margin-top: 20px;">
                                    <a href="#post-3" class="readmore" id="pagination"><i class="glyphicon glyphicon-chevron-right"></i></a>
                                    <a href="#post-1" class="readmore" id="pagination"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a href="#blog" class="readmore"><i class="glyphicon glyphicon-chevron-left"></i> All Posts</a>
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