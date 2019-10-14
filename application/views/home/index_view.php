<!DOCTYPE html>

<html>

<head>
    <title><?= $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local ?> | <?= $data->landingPageInfo->title ?></title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <meta name="description" content="<?= $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local ?> <?= $data->landingPageInfo->title ?> Personal Web Page" />

    <!-- head LESS libraries -->
    <link rel="stylesheet/less" type="text/css" href="/less/landing-page.less" />

    <!-- COMPILE FROM LESS TO CSS SCRIPTS -->
    <script type="text/javascript" src="/js/lessjs/less_init.js"></script>
    <script type="text/javascript" src="/js/lessjs/less.2.7.1.min.js"></script>
    <script>//less.watch();</script>

    <!-- head JS libraries -->
    <script type="text/javascript" src="/js/jquery/3.4.1/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/js/landing-page.js"></script>
</head>

<body class="frt-cloak">
    <div class="root-div">
        <div class="landing-box-div">
            <div class="landing-box-div-inner">
                <h4 class="yazi_mavi" style="font-size: unset;">As a Software Engineer</h4>
                <br />
                <div>
                    <?php foreach ($data->landingPageInfo->sections[0]->socialLinks as $sl) { ?>
                        <a href="<?= $sl->link ?>" target="_blank"><?= $sl->nameFancy ?></a> &nbsp;&nbsp;
                    <?php } ?>
                </div>
                <br />
            </div>
        </div>
        <div class="landing-box-div">
            <div class="landing-box-div-inner">
                <h4 class="yazi_mavi" style="font-size: unset;">As a Musician</h4>
                <br />
                <div>
                    <?php foreach ($data->landingPageInfo->sections[1]->socialLinks as $sl) { ?>
                        <a href="<?= $sl->link ?>" target="_blank"><?= $sl->nameFancy ?></a> &nbsp;&nbsp;
                    <?php } ?>
                </div>
                <br />
            </div>
        </div>
        <div class="landing-box-div">
            <div class="landing-box-div-inner">
                <h4 class="yazi_mavi" style="font-size: unset;">As a Human</h4>
                <br />
                <div>
                    <?php foreach ($data->landingPageInfo->sections[2]->socialLinks as $sl) { ?>
                        <a href="<?= $sl->link ?>" target="_blank"><?= $sl->nameFancy ?></a> &nbsp;&nbsp;
                    <?php } ?>
                </div>
                <br />
            </div>
        </div>
        <div class="clear"></div>
    </div>
</body>

</html>