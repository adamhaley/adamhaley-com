<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Str;

class UpsertPostAction
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function __invoke(array $data): Post
    {
        $data['raw_payload'] ??= $data;
        $data['slug'] ??= $this->uniqueSlug($data['title']);

        // Only dedupe when the source actually supplies a stable external id
        // (e.g. a vault page's per-idea slug). Sources without one should
        // always create a new row - matching on a shared null external_id
        // would otherwise merge unrelated posts.
        if (empty($data['source_external_id'])) {
            $post = Post::create($data);

            return $post->refresh();
        }

        $post = Post::firstOrNew([
            'source' => $data['source'],
            'source_external_id' => $data['source_external_id'],
        ]);

        if ($post->exists) {
            // Once a post exists here, imports only fill fields the post
            // doesn't already have a value for - they never overwrite one,
            // even if the import's value has since changed. raw_payload is
            // exempt - it's a debug snapshot of the last import call, not
            // user-facing post content.
            foreach ($data as $key => $value) {
                if ($key !== 'raw_payload' && blank($post->{$key})) {
                    $post->{$key} = $value;
                }
            }
            $post->raw_payload = $data['raw_payload'];
        } else {
            $post->fill($data);
        }

        $post->save();

        return $post->refresh();
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'post';
        $slug = $base;
        $suffix = 2;

        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
