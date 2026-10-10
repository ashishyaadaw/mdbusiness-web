<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $preview['title'] }} | MD Business</title>
    <meta name="robots" content="noindex">

    {{-- Link preview for WhatsApp / Facebook / Telegram --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="MD Business">
    <meta property="og:title" content="{{ $preview['title'] }}">
    <meta property="og:description" content="{{ $preview['description'] }}">
    <meta property="og:image" content="{{ $preview['image'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="/assets/favicon-32x32.png">
    <style>
        :root { --brand: #1B4F72; --accent: #D81B60; }
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; display: flex; align-items: center;
            justify-content: center; padding: 24px 16px;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: #F8FAFC; color: #212121; text-align: center;
        }
        .card { width: 100%; max-width: 380px; }
        .logo { width: 180px; max-width: 70%; }
        h1 { font-size: 20px; margin: 20px 0 8px; }
        p { color: #555; margin: 0 0 24px; line-height: 1.5; }
        .btn {
            display: block; padding: 14px; border-radius: 12px; margin-bottom: 12px;
            font-weight: 600; text-decoration: none; font-size: 16px;
        }
        .primary { background: var(--brand); color: #fff; }
        .secondary { border: 1.5px solid var(--brand); color: var(--brand); }
        .spinner {
            width: 28px; height: 28px; margin: 0 auto 16px; border-radius: 50%;
            border: 3px solid #d6e2ea; border-top-color: var(--brand);
            animation: spin .8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .hidden { display: none; }
    </style>
</head>
<body>
<main class="card">
    <img class="logo" src="/assets/icon/mdbusiness.png" alt="MD Business">
    <h1>{{ $preview['title'] }}</h1>

    <div id="opening">
        <div class="spinner"></div>
        <p>Opening the MD Business app…</p>
    </div>

    <div id="actions" class="hidden">
        <p>View this on the MD Business app.</p>
        <a id="open-app" class="btn primary" href="{{ $schemeUrl }}">Open in app</a>
        <a class="btn secondary" href="{{ $playStoreUrl }}">Get it on Google Play</a>
        @if ($appStoreUrl)
            <a class="btn secondary" href="{{ $appStoreUrl }}">Download on the App Store</a>
        @endif
    </div>
</main>

<script>
(function () {
    var ua = navigator.userAgent || '';
    var isAndroid = /Android/i.test(ua);
    var isIOS = /iPhone|iPad|iPod/i.test(ua);
    var intentUrl = @json($intentUrl);
    var schemeUrl = @json($schemeUrl);
    var playStoreUrl = @json($playStoreUrl);
    var appStoreUrl = @json($appStoreUrl);

    function showActions() {
        document.getElementById('opening').classList.add('hidden');
        document.getElementById('actions').classList.remove('hidden');
    }

    // On Android the intent link opens the app itself, not a page.
    if (isAndroid) {
        document.getElementById('open-app').href = intentUrl;
    }

    // Desktop, or iOS before the app is on the App Store: offer the store.
    if (!isAndroid && !(isIOS && appStoreUrl)) {
        showActions();
        return;
    }

    // If the app opens, this page goes to the background; don't redirect then.
    var appOpened = false;
    document.addEventListener('visibilitychange', function () {
        if (document.hidden) appOpened = true;
    });
    window.addEventListener('pagehide', function () { appOpened = true; });

    // Chrome/Samsung Internet: opens the app if installed, otherwise follows
    // the intent's Play Store fallback.
    window.location.href = isAndroid ? intentUrl : schemeUrl;

    // Browsers that ignore the intent/scheme (some in-app browsers):
    // go to the store, and leave buttons in case the user comes back.
    setTimeout(function () {
        showActions();
        if (appOpened) return;
        var store = isAndroid ? playStoreUrl : appStoreUrl;
        if (store) window.location.href = store;
    }, 2500);
})();
</script>
</body>
</html>
