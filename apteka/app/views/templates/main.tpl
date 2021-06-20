<!DOCTYPE HTML>
<!--
        ZeroFour by HTML5 UP
        html5up.net | @ajlkn
        Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>PHP Projekt</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="{$conf->app_url}/assets/css/main.css" />
    </head>
    <body class="homepage is-preload">
        <div id="page-wrapper">

            <!-- Header -->
            <div id="header-wrapper">
                <div class="container">

                    <!-- Header -->
                    <header id="header">
                        <div class="inner">

                            <!-- Logo -->
                            <h1><a href="index.html" id="logo">Apteka Online</a></h1>

                            <!-- Nav -->
                            <nav id="nav">
                                <ul>
                                    <li class="current_page_item"><a href="{url action='mainView'}">Strona główna</a></li>   
                                    <li><a href="{url action='browser'}">Wyszukiwarka produktów</a></li>
                                    {if \core\RoleUtils::inRole('admin')}
                                        <li>
                                            <a>Panel Administratora</a>
                                            <ul>
                                                <li><a href="{url action='adminPanel'}">Wyszukaj użytkownika</a></li>
                                                <li><a href="{url action='userAdd'}">Dodaj użytkownika</a></li>
                                            </ul>
                                        </li>
                                    {/if}
                                    {if \core\RoleUtils::inRole('admin') || \core\RoleUtils::inRole('user')}
                                        <li><a href="{url action='logout'}">Wyloguj się</a></li>
                                    {else}
                                        <li><a href="{url action='login'}">Zaloguj się</a></li>
                                    {/if}
                                </ul>
                            </nav>

                        </div>
                    </header>

                    <!-- Banner -->
                    <div id="banner" style="min-height: 31.5em">
                    {block name=content}{/block}
                </div>
                <div>
                {block name=messages}{/block}
            </div>
        </div>
    </div>
</div>

<!-- Footer Wrapper -->
<div id="footer-wrapper" style="padding: 1em 0 0 0">
    <footer id="footer" class="container">
        <div class="row">
            <div class="col-3 col-6-medium col-12-small">

                <!-- Links -->
                <section>
                    <h2>Szablon strony:</h2>
                    <ul class="divided">
                        <li><a href="https://html5up.net/zerofour">ZeroFour</a></li>
                    </ul>
                </section>

            </div>
            <div class="col-6 col-12-medium imp-medium">

                <!-- About -->
                <section>
                    <h2><strong>Apteka Online</strong> stworzona przez Michał Jagieła</h2>
                    <p>Projekt zaliczeniowy na zajęcia JPDSI</p>
                </section>

            </div>
            <div class="col-12">
                <div id="copyright">
                    <ul class="menu">
                        <li>&copy; Michał Jagieła. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

</div>

<!-- Scripts -->
<script src="{$conf->app_url}/assets/js/jquery.min.js"></script>
<script src="{$conf->app_url}/assets/js/jquery.dropotron.min.js"></script>
<script src="{$conf->app_url}/assets/js/browser.min.js"></script>
<script src="{$conf->app_url}/assets/js/breakpoints.min.js"></script>
<script src="{$conf->app_url}/assets/js/util.js"></script>
<script src="{$conf->app_url}/assets/js/main.js"></script>

</body>
</html>
