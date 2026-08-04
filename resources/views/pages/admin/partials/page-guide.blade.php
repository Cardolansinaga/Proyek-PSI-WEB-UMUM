@php
    $guideTitle = $title ?? 'Panduan singkat';
    $guideDescription = $description ?? 'Ikuti langkah di bawah ini agar perubahan tersimpan dengan benar.';
    $guideItems = $items ?? [];
@endphp

<section class="admin-guide" aria-label="{{ $guideTitle }}">
    <div class="admin-guide-heading">
        <span class="admin-guide-icon" aria-hidden="true"><i class="bi bi-info-circle"></i></span>
        <div>
            <h2>{{ $guideTitle }}</h2>
            <p>{{ $guideDescription }}</p>
        </div>
    </div>
    @if (! empty($guideItems))
        <ol class="admin-guide-list">
            @foreach ($guideItems as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ol>
    @endif
    @if ($errors->any())
        <div class="alert-error" role="alert">
            <strong>Periksa kembali isian berikut:</strong>
            <ul style="margin: 8px 0 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</section>
