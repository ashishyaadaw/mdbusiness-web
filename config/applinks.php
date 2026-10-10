<?php

/*
| Links shared from the MD Business app look like https://mdbusiness.in/app/...
| If the app is installed they open it directly (Android App Links / iOS
| Universal Links); otherwise /app/... sends the visitor to the store.
*/

return [

    'android_package' => env('ANDROID_APP_PACKAGE', 'com.oneadvertisers.mdbusiness'),

    /*
    | SHA-256 fingerprints of every key that signs an installed build. Android
    | only opens links straight in the app when the installed build's key is
    | listed here.
    |
    | The Play Store build is signed by Google: copy its fingerprint from Play
    | Console -> Test and release -> App integrity -> App signing key
    | certificate, and add it to ANDROID_APP_SHA256 (comma-separated).
    */
    'android_sha256' => array_values(array_filter(array_map('trim', array_merge(
        explode(',', (string) env('ANDROID_APP_SHA256', '')),
        [
            // Upload key (locally built release APKs)
            '55:F9:A3:C4:93:35:BF:67:7F:52:C5:78:E6:47:45:5E:F9:6E:DE:DF:16:DB:DA:80:30:48:15:36:06:17:4C:6F',
            // Debug key (development builds)
            'BE:5C:73:26:1A:60:13:85:77:4D:0F:B0:C8:AC:AC:B6:E0:FE:5A:1B:B7:BF:FB:2F:A6:69:43:08:B2:A3:5F:96',
        ],
    )))),

    'play_store_url' => env(
        'ANDROID_PLAY_STORE_URL',
        'https://play.google.com/store/apps/details?id=com.oneadvertisers.mdbusiness',
    ),

    // iOS: set both once the app is on the App Store.
    'apple_team_id' => env('APPLE_TEAM_ID'),
    'ios_bundle_id' => env('IOS_BUNDLE_ID', 'com.oneadvertisers.mdbusiness'),
    'app_store_url' => env('IOS_APP_STORE_URL'),

    // Custom scheme the app also handles (mdbusiness://app/...).
    'scheme' => 'mdbusiness',
];
