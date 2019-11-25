<h1 class="h-bloc"><?= $blogData->blogTitle ?></h1>

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page" blog-page-type="upload-images">
            <!-- start Page Blog -->
            <section id="blog-page" style="margin-bottom: 15px;">

                <div class="title_content">
                    <div class="text_content">Upload New Images</div>
                    <div class="clear"></div>
                </div>

                <div style="margin-bottom: 20px;">
                    <input type="file" name="fileInput" multiple="multiple" accept="image/*" style="display: inline;" />
                    <button type="button" name="btnUploadImages">Resimleri Yükle</button>
                    <br />
                    veya &nbsp;<input type="text" name="tbxToPasteImg" placeholder="Resmi buraya yapıştır..." />
                </div>

                <div class="title_content">
                    <div class="text_content">Uploaded Images (<b><?= count($blogData->imagesGrouped) ?></b> grouped / <b><?= count($blogData->images) ?></b> total)</div>
                    <div class="clear"></div>
                </div>

                <div id="upload-images-wrapper">

                    <?php foreach ($blogData->imagesGrouped as $key => $value) { ?>

                        <div class="upload-image-wrapper" grouped-imgs-data="<?= htmlspecialchars(json_encode($value), ENT_QUOTES) ?>" onclick="window.open('<?= SOFTWARE_ENGINEER_BLOG_IMG_UPLOAD_PATH . (isset($value[1]) ? $value[1]->name : $value[0]->name) ?>','_blank')" style="background-image: url('<?= SOFTWARE_ENGINEER_BLOG_IMG_UPLOAD_PATH . $value[0]->name ?>')">
                            <input type="text" name="tbxImgFileName" value="<?= htmlspecialchars(isset($value[1]) ? $value[1]->name : $value[0]->name, ENT_QUOTES) ?>" />
                            <div class="upload-image-delete">X</div>
                        </div>

                    <?php } ?>

                </div>

            </section>

            <!-- End Page Blog -->

        </div>

    </div>
</div>