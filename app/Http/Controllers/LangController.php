<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index()
    {
        dump( app()->getLocale() );
        return view('home');
    }

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
