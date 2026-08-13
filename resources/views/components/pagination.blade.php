@props(['total' => 24, 'perPage' => 10, 'currentPage' => 1])

<div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 p-3 bg-white border-top">
    <div class="small text-muted font-monospace" style="font-size: 0.775rem;">
        SHOWING 1–{{ min($perPage, $total) }} OF {{ $total }} ENTRIES
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm mb-0">
            <li class="page-item disabled">
                <a class="page-link border-0 text-muted" href="#" aria-label="Previous">
                    <i data-lucide="chevron-left" style="width: 14px; height: 14px;"></i>
                </a>
            </li>
            <li class="page-item active"><a class="page-link border-0 bg-dark text-white fw-bold" href="#">1</a></li>
            <li class="page-item"><a class="page-link border-0 text-dark" href="#">2</a></li>
            <li class="page-item"><a class="page-link border-0 text-dark" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link border-0 text-dark" href="#" aria-label="Next">
                    <i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>
