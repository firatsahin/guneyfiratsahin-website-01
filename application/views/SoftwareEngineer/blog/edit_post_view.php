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
                                <span name="post-id" style="display: none;"><?= $blogData->post->id ?></span>
                                <span name="edit-post-key" style="display: none;"><?= $_GET['edit_post_key'] ?></span>
                            </div>

                            <div class="title_content">
                                <div class="text_content">
                                    Banner Images of the Post
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="images-wrapper" style="margin-bottom: 20px;">
                                <?php if (isset($post->images) && is_array($post->images)) { ?>
                                    <?php for ($i = 0; $i < count($post->images); $i++) { ?>

                                        <div post-image-id="<?= $post->images[$i]->id ?>" style="margin-bottom: 20px;">
                                            <div class="left" style="width: 400px; height: 160px; background: url('<?= SOFTWARE_ENGINEER_BLOG_IMG_UPLOAD_PATH . $post->images[$i]->src ?>') no-repeat center; background-size: contain;"></div>
                                            <div class="left" style="width: calc(100% - 400px)">
                                                <button type="button" name="btnSaveImage">Save</button>
                                                <button type="button" name="btnDeleteImage">Del</button>
                                                <span name="span-move" style="cursor: move;">Move</span>

                                                <input type="text" name="tbxImageSrc" value="<?= htmlspecialchars($post->images[$i]->src, ENT_QUOTES) ?>" maxlength="100" />
                                                <input type="text" name="tbxImageLabel" value="<?= htmlspecialchars($post->images[$i]->label, ENT_QUOTES) ?>" maxlength="100" />
                                                <textarea style="width: 100%; height: 80px; resize: vertical;" maxlength="250"><?= $post->images[$i]->text ?></textarea>
                                            </div>
                                            <div class="clear"></div>
                                        </div>

                                    <?php } ?>
                                <?php } ?>

                                <button type="button" name="btnAddNewImage">+ Add New Image (Top Banner)</button>
                            </div>

                            <div class="title_content">
                                <div class="text_content">Post Title</div>
                                <div class="clear"></div>
                            </div>
                            <div>
                                <input type="text" name="tbxPostTitle" value="<?= htmlspecialchars($blogData->post->title, ENT_QUOTES) ?>" maxlength="100" style="width: calc(100% - 50px);" />
                                <button type="button" name="btnSaveTitle">Save</button>
                            </div>

                            <div class="title_content">
                                <div class="text_content">Post Description</div>
                                <div class="clear"></div>
                            </div>
                            <div>
                                <input type="text" name="tbxPostDescription" value="<?= htmlspecialchars($blogData->post->description, ENT_QUOTES) ?>" maxlength="250" style="width: calc(100% - 50px);" />
                                <button type="button" name="btnSaveDescription">Save</button>
                            </div>

                            <div class="title_content" style="margin-top: 20px;">
                                <div class="text_content">Post Contents</div>
                                <div class="clear"></div>
                            </div>
                            <div class="contents-wrapper" style="margin-bottom: 20px;">

                                <?php if (isset($post->contents) && is_array($post->contents)) { ?>
                                    <?php for ($i = 0; $i < count($post->contents); $i++) { ?>

                                        <div content-id="<?= $post->contents[$i]->id ?>" content-type-id="<?= $post->contents[$i]->contentTypeId ?>">
                                            <div class="left" style="width: 92%">

                                                <?php if ($post->contents[$i]->contentTypeId == "1") { ?>

                                                    <textarea style="width: 100%; height: 180px; resize: vertical;" maxlength="3000"><?= $post->contents[$i]->content ?></textarea>
                                                    <span name="remaining-chars" style="font-size: 11px;"></span>

                                                <?php } ?>

                                                <?php if ($post->contents[$i]->contentTypeId == "2") {
                                                    $jsonObj = json_decode($post->contents[$i]->content);
                                                    if (!$jsonObj) $jsonObj = (object)[];
                                                    ?>

                                                    <div name="images-wrapper">
                                                        <?php if (isset($jsonObj->images) && is_array($jsonObj->images)) { ?>
                                                            <?php foreach ($jsonObj->images as $image) { ?>
                                                                <div name="image-wrapper">
                                                                    <input type="text" name="tbxImageUrl" value="<?= htmlspecialchars($image->url, ENT_QUOTES) ?>" />
                                                                    <input type="text" name="tbxImageCaption" value="<?= htmlspecialchars($image->caption, ENT_QUOTES) ?>" />
                                                                    <button name="btnDeleteImageDiv">Del</button>
                                                                    <span name="content-type-2-span-move" style="cursor: move;">Move</span>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <button type="button" name="btnAddImageUrlTextbox">+ Add New Image (Content)</button>

                                                <?php } ?>

                                                <?php if ($post->contents[$i]->contentTypeId == "3") { ?>

                                                    <textarea style="width: 100%; height: 180px; resize: vertical; font-family: monospace;" maxlength="3000"><?= $post->contents[$i]->content ?></textarea>
                                                    <span name="remaining-chars" style="font-size: 11px;"></span>

                                                <?php } ?>

                                                <?php if ($post->contents[$i]->contentTypeId == "4") {
                                                    $jsonObj = json_decode($post->contents[$i]->content);
                                                    if (!$jsonObj) $jsonObj = (object)[];
                                                    ?>

                                                    <select name="ddlHeaderType">
                                                        <option value="">-- Select Header Type --</option>
                                                        <?php for ($k = 1; $k <= 6; $k++) { ?>
                                                            <option <?= isset($jsonObj->headerType) && $jsonObj->headerType === 'h' . $k ? 'selected' : '' ?> >h<?= $k ?></option>
                                                        <?php } ?>
                                                    </select> type header
                                                    <br /><br />
                                                    <input type="text" name="tbxHeaderText" value="<?= isset($jsonObj->headerText) ? htmlspecialchars($jsonObj->headerText, ENT_QUOTES) : '' ?>" placeholder="Header Text" style="width: 100%;" />

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
                                                    <input type="text" name="tbxTagName" value="<?= htmlspecialchars($post->tags[$i], ENT_QUOTES) ?>" />
                                                </div>

                                            <?php } ?>
                                        <?php } ?>

                                    </div>

                                    <button type="button" name="btnAddTagTextbox">+ Add New Tag Textbox</button>
                                    <button type="button" name="btnSaveTags">Save Tags</button>

                                    <div class="title_content">
                                        <div class="text_content">
                                            Category Mapping
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div>
                                        Category:
                                        <select name="ddlCategoryId">
                                            <?php
                                            function writeCategoriesDdl($categories, $level, $post)
                                            {
                                                foreach ($categories as $c) {
                                                    $prefix = '';
                                                    for ($i = 0; $i < $level; $i++) $prefix .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                    echo '<option value="' . $c->id . '" ' . ($c->id == $post->categoryId ? 'selected="selected"' : '') . '>' . $prefix . $c->name . '</option>';
                                                    if (isset($c->subCategories)) writeCategoriesDdl($c->subCategories, $level + 1, $post);
                                                }
                                            }
                                            writeCategoriesDdl($blogData->categories, 0, $post);
                                            ?>
                                        </select>
                                        <button type="button" name="btnSaveCategoryId">Save Category of the Post</button>
                                    </div>

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
                                        <div class="text_content"><?= count($post->comments) ?> Comment<?= count($post->comments) == 1 ? '' : 's' ?></div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="comments">

                                        <?php if (isset($post->comments) && is_array($post->comments) && count($post->comments) > 0) { ?>
                                            <?php for ($i = 0; $i < count($post->comments); $i++) { ?>

                                                <div class="comment <?= !$post->comments[$i]->isPublished ? 'new' : '' ?>" comment-id="<?= $post->comments[$i]->id ?>">
                                                    <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                    <div class="text">
                                                        <div class="name"><?= $post->comments[$i]->commenterFullName ?>
                                                            <a class="reply" href="#" name="lnkReplyToComment">Reply</a>
                                                            <a class="reply" href="#" name="lnkChangePublishStatus" publish-status="<?= ($post->comments[$i]->isPublished ? '1' : '0') ?>"><?= ($post->comments[$i]->isPublished ? 'Unpublish' : 'Publish') ?></a>
                                                        </div>
                                                        <div class="date"><?= substr($post->comments[$i]->commentedDatetime, 0, 19) ?></div>
                                                        <div><?= $post->comments[$i]->commentText ?></div>
                                                    </div>

                                                    <div class="reply-to-wrapper" style="display: none;">
                                                        <textarea name="commentText" style="width: 500px; height: 100px;"></textarea>
                                                        <button type="button" name="btnReplyToComment">Reply To Comment</button>
                                                    </div>

                                                    <?php if (isset($post->comments[$i]->replies) && is_array($post->comments[$i]->replies)) { ?>
                                                        <?php foreach ($post->comments[$i]->replies as $commentReply) { ?>

                                                            <div class="comment sub">
                                                                <img src="/as-a-software-engineer/images/frt-images/frt_profile_pic.jpg" width="100" height="100" alt="img" />
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
                                            <p style="margin-bottom: 10px;">No comments to this post yet.</p>
                                        <?php } ?>

                                    </div><!-- .post_comments -->

                                    <div class="clear"></div>
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