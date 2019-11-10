<h1 class="h-bloc"><?= $blogData->blogTitle ?></h1><br>

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page">
            <!-- start Page Blog -->
            <section id="blog-page">

                <?= json_encode($blogData->categories) ?>

            </section>

            <!-- End Page Blog -->

        </div>

    </div>
</div>