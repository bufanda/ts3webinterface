<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teamspeak 3 - Premium Webinterface</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="templates/{$tmpl}/gfx/style.css?v={$wi_version}" type="text/css" media="screen" />
    <link rel="stylesheet" href="templates/{$tmpl}/gfx/tsview.css?v={$wi_version}" type="text/css" media="screen" />
</head>
<body class="theme-glass">
    <div class="app-background"></div>
    <div class="app-container">
        <!-- Header -->
        <header class="glass-panel main-header">
            {include file="{$tmpl}/head.tpl"}
        </header>

        {include file="{$tmpl}/showupdate.tpl"}
        
        <div class="app-body">
            <!-- Sidebar Navigation -->
            <aside class="glass-panel sidebar">
                {include file="{$tmpl}/mainbar.tpl"}
            </aside>

            <!-- Main Content Area -->
            <main class="glass-panel content-area">
                {include file="{$tmpl}/{$site}.tpl"}
            </main>
        </div>

        <!-- Footer -->
        <footer class="main-footer">

            <p>Psychokiller's Webinterface {$wi_version} | Copyright by Psychokiller | Powered by <a href="https://www.ts-rent.de" target="_blank">TS-Rent.de</a></p>
        </footer>
    </div>
    <script src="templates/{$tmpl}/gfx/app.js?v={$wi_version}"></script>
</body>
</html>