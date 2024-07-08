<?php 


namespace App\Http\Middleware;

use Closure;
use App\Services\ContentModerationService;

class CheckContentBeforeAddPost
{
    public function handle($request, Closure $next)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        $moderationService = new ContentModerationService();
        $hasHarmfulTitle = $moderationService->containsHarmfulContent($title);
        $hasHarmfulContent = $moderationService->containsHarmfulContent($content);
    
        if ($hasHarmfulTitle || $hasHarmfulContent) {
            $request->merge(['is_flagged' => 1]); // Mark as flagged content
        } else {
            $request->merge(['is_flagged' => 0]); // Or any other default status
        }

        return $next($request);
    }
}
