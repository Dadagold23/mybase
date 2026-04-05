@extends('layouts.app')

@section('content')
    <section class="hero-shell">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-primary mb-3">Official gateway</span>
                <h1 class="display-5 text-dark">{{ $heroTitle }}</h1>
                <p class="lead text-muted">{{ $heroCopy }}</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="#resources" class="btn btn-primary">Explore resources</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-secondary">Talk to our team</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-4">
                    <article class="feature-card h-100">
                        <div class="feature-icon"><i class="{{ $service['icon'] }}"></i></div>
                        <h3>{{ $service['title'] }}</h3>
                        <p class="text-muted">{{ $service['body'] }}</p>
                    </article>
                </div>
            @endforeach
        </div>
    </section>

    <section id="resources" class="py-5">
        <h2>Official documents and public assets</h2>
        <div class="row g-4 mt-3">
            @foreach($resourceLinks as $resource)
                <div class="col-md-4">
                    <article class="resource-card h-100">
                        <h3>{{ $resource['label'] }}</h3>
                        <a href="{{ $resource['url'] }}" target="_blank" class="btn btn-outline-{{ $resource['variant'] }}">Open document</a>
                    </article>
                </div>
            @endforeach
        </div>
    </section>

    <section class="py-5">
        <h2>Curated external portals</h2>
        @foreach($gatewayCategories as $category)
            <div class="mb-4 p-4 bg-white rounded shadow-sm">
                <h3>{{ $category['title'] }}</h3>
                <ul class="list-unstyled mb-0">
                    @foreach($category['links'] as $link)
                        <li><a href="{{ $link['url'] }}" target="_blank">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </section>
@endsection
