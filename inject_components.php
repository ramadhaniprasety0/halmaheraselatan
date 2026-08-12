<?php

$file = 'c:\laragon\www\halsea\resources\views\welcome.blade.php';
$content = file_get_contents($file);

// Replace static destinations with component loop
$staticDestinations = '/<!-- Static fallback data for now.*<!-- More cards can be added dynamically later -->/s';
$dynamicDestinations = <<<'HTML'
@foreach($destinations as $destination)
                    <x-destination-card :destination="$destination" />
                @endforeach
HTML;
$content = preg_replace($staticDestinations, $dynamicDestinations, $content);

// Replace static events with component loop
$staticEvents = '/<!-- Static Event fallback -->.*?<\/a>/s';
$dynamicEvents = <<<'HTML'
@foreach($events as $event)
                    <x-event-card :event="$event" />
                @endforeach
HTML;
$content = preg_replace($staticEvents, $dynamicEvents, $content);

file_put_contents($file, $content);

// And we still need to add the missing sections from beranda.html (Packages, Map, Culinary).
// Let's just create a new welcome.blade.php fully populated since the sections are independent.
