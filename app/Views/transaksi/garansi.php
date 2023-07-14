<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $tittle; ?></title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?= $this->include('layout/header_head'); ?>


</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <?= $this->include('layout/sidebar_left'); ?>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <?= $this->include('layout/header'); ?>
                <!-- Top Bar End -->

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="/">VSKomputer</a></li>
                                            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                                            <li class="breadcrumb-item active">Garansi</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Garansi</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">HTML Highlight</h4>
                                        <p class="text-muted m-b-30 font-14">Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind.</p>

                                        <pre class=" language-markup"><code class=" language-markup">
&lt;html&gt;
    &lt;!-- this is a comment --&gt;
    &lt;head&gt;
        &lt;title&gt;HTML Example&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        The indentation tries to be &lt;em&gt;somewhat &amp;quot;do what
        I mean&amp;quot;&lt;/em&gt;... but might not match your style.
    &lt;/body&gt;
&lt;/html&gt;
                                            </code></pre>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">Css Highlight</h4>
                                        <p class="text-muted m-b-30 font-14">Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind.</p>

                                        <pre class="line-numbers">
            <code class="language-css">
.example {
    font-family: Georgia, Times, serif;
    color: #555;
    text-align: center;
}</code>
            </pre>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                        </div> <!-- end row -->

                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <?= $this->include('layout/footerc'); ?>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->
    <?= $this->include('layout/footer_js'); ?>
</body>

</html>