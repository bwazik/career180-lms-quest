@props(['timestamp'])

<span
    x-data="{
        formatTimestamp(timestamp) {
            if (!timestamp) return 'N/A';
            const date = new Date(timestamp + ' Z'); // Append Z to ensure it's treated as UTC
            return new Intl.DateTimeFormat(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                timeZoneName: 'short'
            }).format(date);
        }
    }"
    x-text="formatTimestamp('{{ $timestamp }}')"
    title="{{ $timestamp }} (UTC)"
    {{ $attributes }}
>
    {{ $timestamp }} (UTC)
</span>
