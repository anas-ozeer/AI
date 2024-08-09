<?php

namespace App\Http\Controllers;
use GeminiAPI\Laravel\Facades\Gemini;
use Illuminate\Http\Request;

use function PHPUnit\Framework\matches;
class AIController extends Controller
{
    public function generate(Request $request)
    {
        $prompt = $request->input('prompt');
        if (empty($prompt)) {
            $response = "Please enter a prompt into the field";
        } else {
            $response = Gemini::generateText($prompt);
        }

        // Store the response in the session instead of the URL
        $request->session()->put('ai_response', $response);

        // Redirect to the view method without the response in the URL
        return redirect()->action([AIController::class, 'view']);
    }

    public function view(Request $request)
    {
        // Retrieve the response from the session
        $response = $request->session()->get('ai_response');

        return view('dashboard', [
            'response' => $response
        ]);
    }
}
