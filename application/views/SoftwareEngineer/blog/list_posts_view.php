<h1 class="h-bloc" <?php /*style="height: 39px;"*/?>>
    <div style="position: relative; top: -6px;">

        <span name="blog-title-prefix">Blog:</span>
        <select name="post-set-ddl" post-set="<?= $blogData->postSet ?>">
            <option value="recent-posts">Recent Posts</option>
            <option value="most-clicked-posts">Most Clicked Posts</option>
        </select>

        <?php if (isset($blogData->categoryName) && $blogData->categoryName) { ?>
            <span name="category-span">&nbsp; of <span style="font-weight: 400;"><i><?= $blogData->categoryName ?></i></span></span>
        <?php } ?>

    </div>
</h1><br>

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page" blog-page-type="list-posts">
            <!-- start Page Blog -->
            <section id="blog-page">

                <?php foreach ($blogData->posts as $post) { ?>

                    <!-- Post - Begin -->
                    <article id="post-<?= $post->id ?>" class="blog-article">

                        <div class="col-md-12">

                            <div class="row">

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
                                                                    <img src="<?= SOFTWARE_ENGINEER_BLOG_IMG_UPLOAD_PATH ?><?= $post->images[$i]->src ?>" alt="" />
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
                            </div>

                            <div class="row">
                                <div class="col-md-12 post_content">
                                    <div class="content post_format_standart">
                                        <div class="top_c ">

                                            <div class="title_content">
                                                <div class="text_content">
                                                    <?= $post->title ?>
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <?php $this->load->view('SoftwareEngineer/blog/partial/partial_info_post_view', (object)["post" => $post, "callerPage" => "list-posts"]); ?>

                                            <div class="blog-content">
                                                <?php if (isset($post->contents) && is_array($post->contents) && count($post->contents) > 0) { ?>

                                                    <?php if ($post->contents[0]->contentTypeId == "1") { ?>
                                                        <p>
                                                            <i class="fa fa-quote-left"></i>&nbsp; <?= $post->contents[0]->content ?>
                                                        </p>
                                                    <?php } ?>

                                                <?php } else { ?>
                                                    <p>No content yet.</p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="<?= uri_helper::generateRouteLink("showBlogPostDetail", [$post->title, $post->id]) ?>?from=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="read_m pull-right">Read More <i class='glyphicon glyphicon-chevron-right'></i></a>

                                </div>
                            </div>

                        </div>
                    </article>
                    <!-- Post - End -->

                    <div class="clear"></div>

                <?php } ?>

                <?php if (count($blogData->posts) == 0) { ?>
                    <div style="height: 180px; text-align: center; line-height: 170px;">
                        No posts here yet.
                    </div>
                <?php } ?>

                <article class="blog-article" style="padding: 0px; border-top: 5px solid #3B5998; margin-top: 30px;">
                    <div class="col-md-12 post_content"  style="padding: 10px 15px 0px 15px; text-align: center;">

                        <?php if ($blogData->page > 1) { ?>
                            <a href="<?= uri_helper::generateURIWithQueryString(["p" => $blogData->page - 1 > 1 ? $blogData->page - 1 : null]) ?>" class="readmore" style="float: left;"><i class="glyphicon glyphicon-chevron-left"></i> <?= $blogData->postSet == 'recent-posts' ? 'Newer Posts' : ($blogData->postSet == 'most-clicked-posts' ? 'More Clicked Posts' : '') ?></a>
                        <?php } ?>

                        <?php if ($blogData->page < $blogData->pageCount) { ?>
                            <a href="<?= uri_helper::generateURIWithQueryString(["p" => $blogData->page + 1]) ?>" class="readmore" style="float: right;"><?= $blogData->postSet == 'recent-posts' ? 'Older Posts' : ($blogData->postSet == 'most-clicked-posts' ? 'Less Clicked Posts' : '') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>
                        <?php } ?>

                    </div>

                    <div class="clear"></div>
                </article>

            </section>

            <!-- End Page Blog -->

        </div>

    </div>
</div>