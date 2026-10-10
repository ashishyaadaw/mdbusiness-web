<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Matters\Matter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Makes https://mdbusiness.in/app/... links open the MD Business app.
 *
 * - With the app installed and the domain verified, Android/iOS open the app
 *   without ever requesting /app/... (that's what the two well-known files
 *   are for).
 * - Otherwise the browser loads /app/..., which hands the link to the app if
 *   it is installed, or sends the visitor to the store if it is not.
 */
class AppLinkController extends Controller
{
    /** GET /.well-known/assetlinks.json (Android App Links). */
    public function assetLinks(): JsonResponse
    {
        return response()->json([[
            'relation' => ['delegate_permission/common.handle_all_urls'],
            'target' => [
                'namespace' => 'android_app',
                'package_name' => config('applinks.android_package'),
                'sha256_cert_fingerprints' => config('applinks.android_sha256'),
            ],
        ]], 200, [], JSON_UNESCAPED_SLASHES);
    }

    /** GET /.well-known/apple-app-site-association (iOS Universal Links). */
    public function appleAppSiteAssociation(): JsonResponse
    {
        $teamId = config('applinks.apple_team_id');
        abort_if(blank($teamId), 404);

        return response()->json([
            'applinks' => [
                'details' => [[
                    'appIDs' => [$teamId.'.'.config('applinks.ios_bundle_id')],
                    'components' => [['/' => '/app/*']],
                ]],
            ],
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    /** GET /app/{path} - the shared link itself, when it reaches the browser. */
    public function open(Request $request, string $path = '')
    {
        $path = trim($path, '/');
        $query = $request->getQueryString();
        $appPath = $path.($query ? '?'.$query : '');

        $playStoreUrl = config('applinks.play_store_url');
        $package = config('applinks.android_package');
        $scheme = config('applinks.scheme');

        // Chrome on Android: opens the app if installed, else the fallback URL.
        $intentUrl = 'intent://app/'.$appPath
            .'#Intent;scheme='.$scheme
            .';package='.$package
            .';S.browser_fallback_url='.rawurlencode($playStoreUrl)
            .';end';

        return response()->view('pages.open-app', [
            'intentUrl' => $intentUrl,
            'schemeUrl' => $scheme.'://app/'.$appPath,
            'playStoreUrl' => $playStoreUrl,
            'appStoreUrl' => config('applinks.app_store_url'),
            'preview' => $this->preview($path),
        ])->header('Cache-Control', 'no-store');
    }

    /**
     * Title/description/image for the WhatsApp/Facebook link preview.
     */
    private function preview(string $path): array
    {
        $preview = [
            'title' => 'MD Business',
            'description' => 'Find nearby businesses and services on MD Business.',
            'image' => asset('assets/icon/mdbusiness.png'),
        ];

        if (preg_match('#^matter/(\d+)$#', $path, $m)) {
            try {
                $matter = Matter::find($m[1]);
            } catch (\Throwable $e) {
                // The redirect must work even if the preview lookup fails.
                $matter = null;
            }
            if ($matter) {
                $preview['title'] = $matter->title ?: $preview['title'];
                if ($matter->type === 'image') {
                    $preview['image'] = $matter->image_urls[0] ?? $preview['image'];
                } elseif (filled($matter->payload)) {
                    $text = trim(str_replace('*', '', strip_tags($matter->payload)));
                    $preview['description'] = Str::limit($text, 160);
                }
            }
        }

        return $preview;
    }
}
