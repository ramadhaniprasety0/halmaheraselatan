<?php

// 1. Update EventController
$eventController = <<<'PHP'
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'asc')->paginate(12);
        return view('events.index', compact('events'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('events.show', compact('event'));
    }
}
PHP;
file_put_contents('c:\laragon\www\halsea\app\Http\Controllers\EventController.php', $eventController);


// 2. Update TravelPackageController
$packageController = <<<'PHP'
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TravelPackage;

class TravelPackageController extends Controller
{
    public function index()
    {
        $packages = TravelPackage::orderBy('id', 'desc')->paginate(12);
        return view('packages.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = TravelPackage::where('slug', $slug)->firstOrFail();
        return view('packages.show', compact('package'));
    }
}
PHP;
file_put_contents('c:\laragon\www\halsea\app\Http\Controllers\TravelPackageController.php', $packageController);


// 3. Update routes/web.php
$routesFile = 'c:\laragon\www\halsea\routes\web.php';
$routesContent = file_get_contents($routesFile);
if (strpos($routesContent, 'EventController') === false) {
    $imports = "use App\Http\Controllers\EventController;\nuse App\Http\Controllers\TravelPackageController;\n";
    $routesContent = str_replace("use App\Http\Controllers\DestinationController;\n", "use App\Http\Controllers\DestinationController;\n" . $imports, $routesContent);
    
    $routes = <<<PHP
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

Route::get('/packages', [TravelPackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [TravelPackageController::class, 'show'])->name('packages.show');
PHP;
    $routesContent = preg_replace('/(Route::get\(\'\/destinations\/\{slug\}\'.*?;)/s', "$1\n\n" . $routes, $routesContent);
    file_put_contents($routesFile, $routesContent);
}

echo "Controllers and Routes updated.";
