<?php $post = $blogData->post; ?>

<h1 class="h-bloc">Editing Post: <?= $post->title ?></h1>

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page" blog-page-type="edit-post">

            <!-- Page Blog - Post -->
            <section id="post-<?= $post->id ?>-page" class="content-post">
                <div class="row inner">

                    <div class="col-md-12" style="width: 100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;float: left;background: rgba(255, 255, 255, 0.8);padding-bottom: 15px;padding-top: 15px;">

                        <article class="postPage">

                            <div class="title_content">
                                <div class="text_content">
                                    Tasks about the Post
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="tasks-wrapper" style="margin-bottom: 20px;">
                                <button type="button" name="btnChangePublishStatus" is-published="<?= $blogData->post->isPublished ?>"><?= $blogData->post->isPublished ? 'Unpublish' : 'Publish' ?> Post</button>
                                &nbsp;&nbsp;
                                <a href="?edit_post_key=<?= $_GET['edit_post_key'] ?>&preview=1" target="_blank">Preview Post</a>
                            </div>

                            <div class="title_content">
                                <div class="text_content">
                                    Images of the Post
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="images-wrapper" style="margin-bottom: 20px;">
                                <?php if (isset($post->images) && is_array($post->images)) { ?>
                                    <?php for ($i = 0; $i < count($post->images); $i++) { ?>

                                        <div post-image-id="<?= $post->images[$i]->id ?>" style="margin-bottom: 20px;">
                                            <div class="left" style="width: 400px; height: 160px; background: url('<?= SOFTWARE_ENGINEER_ROOT_URI . $post->images[$i]->src ?>') no-repeat center; background-size: contain;"></div>
                                            <div class="left" style="width: calc(100% - 400px)">
                                                <button type="button" name="btnSaveImage">Save</button>
                                                <button type="button" name="btnDeleteImage">Del</button>
                                                <span name="span-move" style="cursor: move;">Move</span>

                                                <input type="text" name="tbxImageSrc" value="<?= $post->images[$i]->src ?>" maxlength="100" />
                                                <input type="text" name="tbxImageLabel" value="<?= $post->images[$i]->label ?>" maxlength="100" />
                                                <textarea style="width: 100%; height: 80px; resize: vertical;" maxlength="250"><?= $post->images[$i]->text ?></textarea>
                                            </div>
                                            <div class="clear"></div>
                                        </div>

                                    <?php } ?>
                                <?php } ?>

                                <button type="button" name="btnAddNewImage">+ Add New Image</button>
                            </div>

                            <div class="title_content">
                                <div class="text_content">
                                    Title:
                                    <input type="text" name="tbxPostTitle" value="<?= htmlspecialchars($blogData->post->title, ENT_QUOTES) ?>" maxlength="100" />
                                    <button type="button" name="btnSaveTitle">Save Title</button>
                                </div>
                                <div class="clear"></div>
                            </div>

                            Post ID: <span name="post-id"><?= $blogData->post->id ?></span>
                            <br>
                            Edit Post Key: <span name="edit-post-key"><?= $_GET['edit_post_key'] ?></span>

                            <div class="contents-wrapper" style="margin-bottom: 20px;">

                                <?php if (isset($post->contents) && is_array($post->contents)) { ?>
                                    <?php for ($i = 0; $i < count($post->contents); $i++) { ?>

                                        <div content-id="<?= $post->contents[$i]->id ?>" content-type-id="<?= $post->contents[$i]->contentTypeId ?>" style="margin-bottom: 10px;">
                                            <div class="left" style="width: 92%">

                                                <?php if ($post->contents[$i]->contentTypeId == "1") { ?>

                                                    <textarea style="width: 100%; height: 160px; resize: vertical;" maxlength="1000"><?= $post->contents[$i]->content ?></textarea>

                                                <?php } ?>

                                            </div>
                                            <div class="left" style="width: 8%">
                                                <button type="button" name="btnSaveContent">Save</button>
                                                <button type="button" name="btnDeleteContent">Del</button>
                                                <span name="span-move" style="cursor: move;">Move</span>
                                            </div>
                                            <div class="clear"></div>
                                        </div>

                                    <?php } ?>
                                <?php } ?>

                                <button type="button" name="btnAddNewContent">+ Add New Content</button>
                                &nbsp; Type:
                                <select name="ddlContentType">
                                    <?php foreach ($blogData->contentTypes as $ct) { ?>
                                        <option value="<?= $ct->id ?>"><?= $ct->value ?>: <?= $ct->id ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="title_content">
                                <div class="text_content">
                                    Tags
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="col-md-12 first">
                                <div class="info">
                                    <div class="tags-wrapper">

                                        <?php if (isset($post->tags) && is_array($post->tags)) { ?>
                                            <?php for ($i = 0; $i < count($post->tags); $i++) { ?>

                                                <div>
                                                    <input type="text" name="tbxTagName" value="<?= $post->tags[$i] ?>" />
                                                </div>

                                            <?php } ?>
                                        <?php } ?>

                                    </div>

                                    <button type="button" name="btnAddTagTextbox">+ Add New Tag Textbox</button>
                                    <button type="button" name="btnSaveTags">Save Tags</button>

                                    <div class="title_content">
                                        <div class="text_content">
                                            Stats
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <?php $this->load->view('SoftwareEngineer/blog/partial/partial_info_post_view', (object)["post" => $post, "callerPage" => "edit-post"]); ?>
                                </div>

                                <div class="clear"></div>


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