<?php
// VIEW HELPER FUNCTIONS - BEGIN
function writeCategories($categories, $level)
{
    if (count($categories) == 0) return;
    echo '<ul level="' . $level . '">';
    foreach ($categories as $c) {
        echo '<li cat-id="' . $c->id . '" subcat-count="' . count($c->subCategories) . '"><i class="fa fa-chevron-right"></i>';
        echo '<div class="category"><span class="cat-name">' . $c->name . '</span><a href="' . uri_helper::generateRouteLink('listCategoryPosts', [$c->id, $c->name, 'recent-posts', 1]) . '" class="cat-link">See ' . (isset($c->postCount) ? $c->postCount : '') . ' Post' . ($c->postCount == 1 ? '' : 's') . '</a><div class="clear"></div></div>';
        if (isset($c->subCategories)) writeCategories($c->subCategories, $level + 1);
        echo "</li>";
    }
    echo '</ul>';
}
// VIEW HELPER FUNCTIONS - END
?>

<h1 class="h-bloc"><?= $blogData->blogTitle ?></h1>

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page">
            <!-- start Page Blog -->
            <section id="blog-page" style="margin-bottom: 15px;">

                <div class="title_content">
                    <div class="text_content">Post Categories</div>
                    <div style="float: right; font-size: 12px; margin-top: 8px;">
                        <button type="button" class="btn-primary" name="btnExpandAll">Expand All</button>
                        <button type="button" class="btn-primary" name="btnCollapseAll">Collapse All</button>
                    </div>
                    <div class="clear"></div>
                </div>

                <div id="blog-categories">

                    <?php writeCategories($blogData->categories, 0); ?>

                </div>

            </section>

            <!-- End Page Blog -->

        </div>

    </div>
</div>