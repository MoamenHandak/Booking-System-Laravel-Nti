@props([
    'title' => 'Stat Title',
    'value' => '0',
    'icon' => 'calendar-check',
    'trend' => null,
    'trendUp' => true
])

@php
    $faIcon = match($icon) {
        'calendar-check', 'calendar', 'journal-check' => 'fa-solid fa-calendar-check',
        'dollar-sign', 'wallet-2' => 'fa-solid fa-dollar-sign',
        'users' => 'fa-solid fa-users',
        'building-2', 'building' => 'fa-solid fa-hotel',
        'trending-up' => 'fa-solid fa-arrow-trend-up',
        default => 'fa-solid fa-chart-line',
    };
@endphp

<div class="stat-card-box">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="stat-label-text" data-i18n-title="{{ strtolower(str_replace(' ', '_', $title)) }}">{{ $title }}</span>
        <div class="btn-circle btn-circle-blue" style="width: 32px; height: 32px; font-size: 0.85rem;">
            <i class="{{ $faIcon }}"></i>
        </div>
    </div>
    <div class="stat-value-text">{{ $value }}</div>
    @if($trend)
        <div class="stat-trend-badge {{ $trendUp ? 'trend-up' : 'trend-down' }}">
            <i class="{{ $trendUp ? 'fa-solid fa-arrow-trend-up' : 'fa-solid fa-arrow-trend-down' }} me-1"></i>
            <span>{{ $trend }}</span>
            <span class="text-muted fw-normal ms-1" style="font-size: 0.725rem;" data-i18n="vs_last_month">vs last month</span>
        </div>
    @endif
</div>
