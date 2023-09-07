# Laravel Localization with language switcher

## create route
```
Route::post('/change-locale', 'LocaleController@changeLocale')->name('change.locale');
```

## config/app.php
```
  'languages' => ['en', 'kh'],
```

## create controller
```
class LangController extends Controller
{
    public function changeLocale(Request $request)
    {
        // Validate and get the selected locale from the request
        $locale = $request->locale;

        if (in_array($locale, config('app.languages'))) {

            // Set the application's locale
            app()->setLocale($locale);

            // Store the selected locale in the session (optional)
            $request->session()->put('locale', $locale);
        }

        // Redirect back to the previous page or a specific URL
        return back();
    }
}
```

## create option form to switch languages
```
resources/view/
<form method="POST" action="{{ route('change.locale') }}">
    @csrf
    <select name="locale" onchange="this.form.submit()">
        <option value="en" {{ app()->isLocale('en') ? 'selected' : '' }}>English</option>
        <option value="fr" {{ app()->isLocale('fr') ? 'selected' : '' }}>Français</option>
        <option value="es" {{ app()->isLocale('es') ? 'selected' : '' }}>Español</option>
    </select>
</form>
```

## create translation files
```
// resources/lang/en/messages.php
return [
    'welcome' => 'Welcome to our website!',
    'greeting' => 'Hello, :name!',
];
// resources/lang/fr/messages.php
return [
    'welcome' => bal bla bla!',
    'greeting' => 'bla, :name!',
];
```

## create middleware
```
// app/Http/Middleware/SetLocale.php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Determine the user's preferred locale, e.g., from user settings
        // $preferredLocale = $request->user()->locale ?? 'en';

        // Get the locale from session or use default
        $preferredLocale = session('locale', 'en'); 

        // Set the application's locale
        app()->setLocale($preferredLocale);

        return $next($request);
    }
}
```

## register middleware
```
// app/Http/Kernel.php

protected $middlewareGroups = [
    'web' => [
        // ...
        \App\Http\Middleware\SetLocale::class,
    ],
    // ...
];
```
