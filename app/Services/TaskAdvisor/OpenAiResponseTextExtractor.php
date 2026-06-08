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
            foreach (($output['content'] ?? []) as $content) {
                if (is_string($content['text'] ?? null)) {
                    return $content['text'];
                }
            }
        }

        throw new RuntimeException('La reponse IA ne contient pas de texte.');
    }
}
