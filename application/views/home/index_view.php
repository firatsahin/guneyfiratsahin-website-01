<!DOCTYPE html>

<html>

<head>
    <title><?= $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local ?> | <?= $data->landingPageInfo->title ?></title>

    <!-- metas -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- seo -->
    <meta name="description" content="<?= isset($data->landingPageInfo->description) && $data->landingPageInfo->description ? $data->landingPageInfo->description : '' ?>" />
    <link rel="canonical" href="<?= utility_helper::getSiteUrl() ?>"/>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/img/frt-favicon.png"/>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- head LESS libraries -->
    <link rel="stylesheet/less" type="text/css" href="<?= utility_helper::includeVersionedReference('/less/landing-page.less') ?>" />

    <!-- COMPILE FROM LESS TO CSS SCRIPTS -->
    <script type="text/javascript" src="/js/lessjs/less_init.js"></script>
    <script type="text/javascript" src="/js/lessjs/less.2.7.1.min.js"></script>
    <script>//less.watch();</script>

    <!-- head JS libraries -->
    <script type="text/javascript" src="/js/jquery/3.4.1/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?= utility_helper::includeVersionedReference('/js/landing-page.js') ?>"></script>
</head>

<body class="frt-cloak">
    <div class="root-div">

        <?php foreach ($data->landingPageInfo->sections as $section) { ?>
            <div class="landing-box-div <?= $section->linkActive ? 'has-link' : '' ?>" <?= $section->linkActive ? 'title="Go to [' . $section->title . '] section"' : '' ?>>
                <div class="landing-box-div-background" style="<?= isset($section->backgroundImg) && $section->backgroundImg ? 'background-image:url(\'' . $section->backgroundImg . '\');' : '' ?>"></div>
                <div class="landing-box-div-inner">
                    <div class="box-title-container">
                        <a href="<?= $section->linkActive ? '/' . $section->id : '#' ?>" target="<?= $section->linkTarget ?>" class="link-to-section"><?= $section->title ?></a>
                    </div>

                    <div style="height: 25px;"></div>

                    <div class="socmed-icons-container">
                        <?php foreach ($section->socialLinks as $sl) { ?>
                            <a href="<?= $sl->link ?>" target="_blank" class="socmed-link" style="background-image: url('/img/socmed-icons/<?= $sl->name ?>.png')" title="Go to <?= $data->personalInfo->preferredName->global ?>'s <?= $sl->nameFancy ?> profile" rel="nofollow"></a>
                        <?php } ?>
                    </div>

                    <div class="go-to-details-container">
                        <span class="go-to-details-icon"></span>
                        <span class="go-to-details-text"><?= $section->linkActive ? 'Details &nbsp;>' : '' ?></span>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="clear"></div>
    </div>
</body>

</html>