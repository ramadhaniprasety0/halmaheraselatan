<?php

$models = ['Event', 'Culinary', 'Accommodation', 'TravelPackage', 'Room', 'VisitorCounter', 'PageView', 'Review'];
foreach ($models as $m) {
    file_put_contents("app/Models/{$m}.php", "\n}\n", FILE_APPEND);
}
echo "Models fixed.\n";
