<?php

namespace App\Services;

class ContentModerationService
{
    public function containsHarmfulContent($content)
    {
        $badContent = ['badword1', 'badword2', 'bad'];
        foreach ($badContent as $badWord) {
            if (stripos($content, $badWord) !== false) {
                return true;
            }
        }

        return false;
    }
}
