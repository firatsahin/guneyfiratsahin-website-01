<?php
// VIEW HELPER FUNCTIONS - BEGIN
function writeCategories($categories, $level, $blogData)
{
    if (count($categories) == 0) return;
    echo '<ul level="' . $level . '">';
    foreach ($categories as $c) {
        echo '<li cat-id="' . $c->id . '" subcat-count="' . count($c->subCategories) . '"><i class="fa fa-chevron-right"></i>';
        echo '<div class="category"><span class="cat-name">';
        if ($blogData->editMode) {
            echo 'ID:<b>' . $c->id . '</b>';
            echo '&nbsp; <input type="text" name="tbxCatName" value="' . htmlspecialchars($c->name, ENT_QUOTES) . '" maxlength="50" />';
            echo '&nbsp; Parent: <input type="number" name="tbxParentCatID" value="' . $c->parentId . '" style="width: 50px;" />';
            echo '&nbsp; Sort: <input type="number" name="tbxSortNo" value="' . $c->sortNo . '" style="width: 40px;" />';
            //echo '<br />';
            echo '<button name="btnSaveCategory">Save</button>';
            echo '<button name="btnDeleteCategory">Del</button>';
        } else {
            echo $c->name;
        }
        echo '</span>';
        echo '<a href="' . uri_helper::generateRouteLink('listCategoryPosts', [$c->id, $c->name, 'recent-posts', 1]) . '" class="cat-link">See ' . (isset($c->postCount) ? $c->postCount : '') . ' Post' . ($c->postCount == 1 ? '' : 's') . '</a>';
        if ($blogData->editMode) {
            echo '<span class="right"><a href="#" name="lnkAddNewPost">+ Add New Post</a> |&nbsp;</span>';
        }
        echo '<div class="clear"></div></div>';
        if (isset($c->subCategories)) writeCategories($c->subCategories, $level + 1, $blogData);
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
        <div class="col-md-12" id="blog_page" blog-page-type="<?= $blogData->editMode ? 'edit' : 'list' ?>-categories">
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

                    <?php writeCategories($blogData->categories, 0, $blogData); ?>

                </div>

            </section>

            <!-- End Page Blog -->

        </div>

    </div>
</div>

<?php if ($blogData->editMode) { ?>

    <div class="title_content">
        <div class="text_content">Add New Category</div>
        <div class="clear"></div>
    </div>

    <div name="add-new-category">
        New Cat Name: <input type="text" name="tbxCatName" maxlength="50" />
        Parent: <input type="number" name="tbxParentCatID" style="width: 50px;" />
        <button name="btnAddNewCategory">Add New Category</button>
    </div>

    <br />
    Edit Category Key: <span name="edit-category-key"><?= $_GET['edit_category_key'] ?></span>
<?php } ?>
