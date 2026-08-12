<?php

$models = ['Event', 'Culinary', 'Accommodation', 'TravelPackage'];
$path = 'c:\laragon\www\halsea\app\Models\\';

foreach ($models as $model) {
    $file = $path . $model . '.php';
    $content = file_get_contents($file);
    
    $replacement = <<<PHP
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class $model extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected \$guarded = ['id'];
PHP;

    $content = preg_replace('/class ' . $model . ' extends Model\s*{\s*\/\/\s*}/', $replacement, $content);
    file_put_contents($file, $content);
}

// For Room, VisitorCounter, PageView, Review, just add guarded
$other_models = ['Room', 'VisitorCounter', 'PageView', 'Review'];
foreach ($other_models as $model) {
    $file = $path . $model . '.php';
    $content = file_get_contents($file);
    
    $replacement = <<<PHP
class $model extends Model
{
    protected \$guarded = ['id'];
PHP;

    $content = preg_replace('/class ' . $model . ' extends Model\s*{\s*\/\/\s*}/', $replacement, $content);
    file_put_contents($file, $content);
}

echo "Models updated successfully.\n";
