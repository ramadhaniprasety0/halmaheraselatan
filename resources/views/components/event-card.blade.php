@props(['event'])
<a href="/events/{{ $event->slug ?? 'slug' }}" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all block">
    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ $event->image_url ?: 'https://via.placeholder.com/400x300' }}')"></div>
    <div class="p-5">
        <div class="text-primary font-bold text-sm mb-2">{{ $event->date_formatted ?? 'Date' }}</div>
        <h3 class="text-xl font-bold text-on-surface mb-3">{{ $event->name ?? 'Event Name' }}</h3>
        <p class="text-on-surface-variant text-sm mb-4">{{ Str::limit($event->short_description ?? 'Description', 80) }}</p>
        <button class="text-primary font-bold hover:gap-2 transition-all flex items-center text-sm">{{ __('Learn More') }} <span class="material-symbols-outlined ml-2 text-sm">east</span></button>
    </div>
</a>