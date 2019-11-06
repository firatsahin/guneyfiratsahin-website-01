<h1 class="h-bloc">Blog - <?= $blogData->blogTitle ?></h1><br>

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page">
            <!-- start Page Blog -->
            <section id="blog-page">

                <?php foreach ($blogData->recentPosts as $post) { ?>

                    <!-- Post - Begin -->
                    <article id="post-<?= $post->id ?>" class="blog-article">

                        <div class="col-md-12">

                            <div class="row">

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

                                                        <a class="left carousel-control" href="#carousel-<?= $post->id ?>" data-slide="prev">
                                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                                        </a>

                                                        <a class="right carousel-control" href="#carousel-<?= $post->id ?>" data-slide="next">
                                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                                        </a>

                                                    </div>

                                                <?php } else { // single image ?>

                                                    <img src="<?= SOFTWARE_ENGINEER_ROOT_URI ?><?= $post->images[0]->src ?>" class="img-hover" alt="" />

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
                                                <div class="text_content"><a href="<?= uri_helper::generateRouteLink("showBlogPostDetail", [$post->id, $post->postTitle]) ?>"><?= $post->postTitle ?></a></div>
                                                <div class="clear"></div>
                                            </div>

                                            <ul class="info">
                                                <li><i class="glyphicon glyphicon-comment"></i> 2 Comments</li>
                                                <li><i class="glyphicon glyphicon-time"></i> January 31, 2014</li>
                                                <li><i class="glyphicon glyphicon-user"></i> by Jane Doe</li>
                                                <li><i class="glyphicon glyphicon-tag"></i> php, web design</li>
                                            </ul>

                                            <div class="blog-content">
                                                <?php if (isset($post->contents) && is_array($post->contents) && count($post->contents) > 0) { ?>
                                                    <p>
                                                        <i class="fa fa-quote-left"></i>&nbsp; <?= strlen($post->contents[0]) > 300 ? trim(substr($post->contents[0], 0, 300)) . '...' : $post->contents[0] ?>
                                                    </p>
                                                <?php } else { ?>
                                                    <p>No content yet.</p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="<?= uri_helper::generateRouteLink("showBlogPostDetail", [$post->id, $post->postTitle]) ?>" class="read_m pull-right">Read More <i class='glyphicon glyphicon-chevron-right'></i></a>

                                </div>
                            </div>

                        </div>
                    </article>
                    <!-- Post - End -->

                    <div class="clear"></div>

                <?php } ?>

            </section>

            <!-- End Page Blog -->

        </div>

    </div>
</div>