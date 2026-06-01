<?php

namespace App\Services\TaskAdvisor;

use RuntimeException;

class OpenAiResponseTextExtractor
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function extract(array $payload): string
    {
        if (is_string($payload['output_text'] ?? null)) {
            return $payload['output_text'];
        }

        foreach (($payload['output'] ?? []) as $output) {
            $text = $this->extractFromContent($output);

            if ($text !== null) {
                return $text;
            }
        }

        throw new RuntimeException('La reponse IA ne contient pas de texte.');
    }

    private function extractFromContent(mixed $output): ?string
    {
        if (! is_array($output)) {
            return null;
        }

        foreach (($output['content'] ?? []) as $content) {
            if (is_array($content) && is_string($content['text'] ?? null)) {
                return $content['text'];
            }
        }

        return null;
    }
}
