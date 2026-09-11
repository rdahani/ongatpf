<?php

declare(strict_types=1);

class HomeController extends Controller
{
    public function index(): void
    {
        $seo = $this->seo(
            'ATPF Niger | Développement durable et restauration des territoires',
            'Depuis 2001, ATPF accompagne les communautés nigériennes dans la préservation de l\'environnement, la restauration des territoires et le développement durable.'
        );

        view('pages/home', array_merge($seo, [
            'stats' => ImpactStat::forHome(),
            'domains' => Domain::published(),
            'projects' => Project::published(3, true),
            'impactStats' => ImpactStat::published(),
            'regions' => Region::withMeta(),
            'partners' => Partner::published(),
            'news' => News::published(4),
            'testimonials' => Testimonial::published(),
        ]));
    }
}
