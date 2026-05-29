<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;

class PortfolioItem extends Model
{
    //
    protected $fillable = [
        'name',
        'url',
        'title',
        'about',
        'relevance',
        'area_atuacao',
        'area_atuacao_slug',
        'badges',
        'feedback'
    ];

    protected $casts = [
        'badges' => 'array',
        'relevance' => 'float',
    ];

    /**
     * Scope para filtrar os itens mais relevantes.
     */
    public function scopeMostRelevant(Builder $query, int $limit = 5): void
    {
        $query->orderBy('relevance', 'desc')->take($limit);
    }

    public array $data = [];

    private function checkAsset(string $file): string|false
    {
        $path = "images/portfolio/{$this->name}/$file";

        if (!File::exists(public_path($path))) return false;

        return $path;
    }

    private function getFavicon(): string|false
    {
        $favicon = $this->checkAsset("favicon.webp");

        if (!$favicon) {
            $favicon = $this->checkAsset("favicon.ico");
        }

        return $favicon;
    }

    public function render()
    {
        $this->data = [
            'name'      => $this->name,
            'url'       => $this->url,
            'title'     => $this->title,
            'about'     => $this->about,
            'area_atuacao'     => $this->area_atuacao,
            'area_atuacao_slug'     => $this->area_atuacao_slug,
            'feedback'     => $this->feedback,
            'favicon'   => $this->getFavicon(),
            'mobile'    => $this->checkAsset("mobile.webp"),
            'desktop'   => $this->checkAsset("desktop.webp"),
            'cover'     => $this->checkAsset("cover.webp"),
        ];

        $this->data["fullscreen"] = (bool) ($this->data['mobile'] || $this->data['desktop']);

        return view("components.guest.portfolio-card", ["data" => $this->data]);
    }
}
