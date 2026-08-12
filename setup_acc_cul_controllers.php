<?php

// 1. Update AccommodationController
$accController = <<<'PHP'
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Accommodation;

class AccommodationController extends Controller
{
    public function index(Request $request)
    {
        $query = Accommodation::query();
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }
        $accommodations = $query->paginate(12);
        return view('accommodations.index', compact('accommodations'));
    }

    public function show($slug)
    {
        $accommodation = Accommodation::where('slug', $slug)->firstOrFail();
        return view('accommodations.show', compact('accommodation'));
    }
}
PHP;
file_put_contents('c:\laragon\www\halsea\app\Http\Controllers\AccommodationController.php', $accController);


// 2. Update CulinaryController
$culController = <<<'PHP'
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Culinary;

class CulinaryController extends Controller
{
    public function index()
    {
        $culinaries = Culinary::paginate(12);
        return view('culinary.index', compact('culinaries'));
    }

    public function show($slug)
    {
        $culinary = Culinary::where('slug', $slug)->firstOrFail();
        return view('culinary.show', compact('culinary'));
    }
}
PHP;
file_put_contents('c:\laragon\www\halsea\app\Http\Controllers\CulinaryController.php', $culController);


// 3. Update routes/web.php
$routesFile = 'c:\laragon\www\halsea\routes\web.php';
$routesContent = file_get_contents($routesFile);
if (strpos($routesContent, 'AccommodationController') === false) {
    $imports = "use App\Http\Controllers\AccommodationController;\nuse App\Http\Controllers\CulinaryController;\n";
    $routesContent = str_replace("use App\Http\Controllers\MapController;\n", "use App\Http\Controllers\MapController;\n" . $imports, $routesContent);
    
    $routes = <<<PHP
Route::get('/accommodations', [AccommodationController::class, 'index'])->name('accommodations.index');
Route::get('/accommodations/{slug}', [AccommodationController::class, 'show'])->name('accommodations.show');

Route::get('/culinary', [CulinaryController::class, 'index'])->name('culinary.index');
Route::get('/culinary/{slug}', [CulinaryController::class, 'show'])->name('culinary.show');
PHP;
    $routesContent = preg_replace('/(Route::get\(\'\/map\'.*?;)/s', "$1\n\n" . $routes, $routesContent);
    file_put_contents($routesFile, $routesContent);
}

echo "Controllers and Routes updated.";
