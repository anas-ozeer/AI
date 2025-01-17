# Brief Overview

This project, built on Laravel Breeze, features a text input field where users can enter prompts and receive AI-generated responses. It leverages Gemini's capabilities to provide interactive and intelligent responses, enhancing user engagement and experience. 

Note: The commented part is an attempt to use images as input.

## Getting the API Key


### Go to Google AI Studio

- You need an API key to gain access to Google's Gemini API.
- Visit [Google AI Studio](https://ai.google.dev/aistudio) to get an API key.
- On the Homepage, click on [Get Your API KEY](https://aistudio.google.com/app/apikey?_gl=1*a7qmv3*_ga*NDkwNzI1NTU2LjE3MjI4NDU3NzI.*_ga_P1DBVKWT6V*MTcyMjkyNTUwMC40LjEuMTcyMjkyNTk0MS43LjAuNjk2NDc4MjIy) to retrieve your API key.
- Click on create API key and search Generative Language CLient.
Copy the API key and follow the instructions for [Installation](#installation) down below.



# Gemini API Client for Laravel - This is the API I used...Do not use Google-Gemini-PHP

Gemini API Client for Laravel allows you to use the Google's generative AI models, like Gemini Pro and Gemini Pro Vision in your Laravel application.

Supports PHP 8.1 and Laravel v9, v10.

_This library is not developed or endorsed by Google._

- Erdem Köse - **[github.com/erdemkose](https://github.com/erdemkose)**

## Table of Contents
- [Installation-Relevant](#installation) 
- [Configuration-Relevant](#configuration)
- [How to use](#how-to-use)
    - [Text Generation-Relevant](#text-generation)
    - [Text Generation using Image File-Relevant](#text-generation-using-image-file)
    - [Text Generation using Image Data-Relevant](#text-generation-using-image-data)
    - [Chat Session (Multi-Turn Conversations)](#chat-session-multi-turn-conversations)
    - [Chat Session with History](#chat-session-with-history)
    - [Text Embeddings](#text-embeddings)
    - [Tokens counting](#tokens-counting)
    - [Listing models](#listing-models)
    - [Accessing the underlying Gemini API client](#accessing-the-underlying-gemini-api-client)
    - [Parsing the markdown response of Gemini Models](#parsing-the-markdown-response-from-the-model)

## Installation

First step is to install the Gemini API Client for Laravel with Composer.

```shell
composer require gemini-api-php/laravel
```

## Configuration

There are two ways to configure the client. 

### Environment variables

You can set the `GEMINI_API_KEY` environment variable with the API key you obtained from Google AI studio.

Add the following line into your `.env` file.

```shell
GEMINI_API_KEY='YOUR_GEMINI_API_KEY'
```

### Configuration file

You can also run the following command to create a configuration file in your applications config folder.

```shell
php artisan vendor:publish --provider=GeminiAPI\Laravel\ServiceProvider
```

Now you can edit the `config/gemini.php` file to configure the Gemini API client.

## How to use

### Text Generation

```php
use GeminiAPI\Laravel\Facades\Gemini;

print Gemini::generateText('PHP in less than 100 chars');
// PHP: A server-side scripting language used to create dynamic web applications.
// Easy to learn, widely used, and open-source.
```

### Text Generation Using Image File

```php
use GeminiAPI\Laravel\Facades\Gemini;

print Gemini::generateTextUsingImageFile(
    'image/jpeg',
    'elephpant.jpg',
    'Explain what is in the image',
);
// The image shows an elephant standing on the Earth.
// The elephant is made of metal and has a glowing symbol on its forehead.
// The Earth is surrounded by a network of glowing lines.
// The image is set against a starry background.
```

### Text Generation Using Image Data

```php
use GeminiAPI\Laravel\Facades\Gemini;

print Gemini::generateTextUsingImage(
    'image/jpeg',
    base64_encode(file_get_contents('elephpant.jpg')),
    'Explain what is in the image',
);
// The image shows an elephant standing on the Earth.
// The elephant is made of metal and has a glowing symbol on its forehead.
// The Earth is surrounded by a network of glowing lines.
// The image is set against a starry background.
```

### Chat Session (Multi-Turn Conversations)

```php
use GeminiAPI\Laravel\Facades\Gemini;

$chat = Gemini::startChat();

print $chat->sendMessage('Hello World in PHP');
// echo "Hello World!";
// This code will print "Hello World!" to the standard output.

print $chat->sendMessage('in Go');
// fmt.Println("Hello World!")
// This code will print "Hello World!" to the standard output.
```

### Chat Session with History

```php
use GeminiAPI\Laravel\Facades\Gemini;

$history = [
    [
        'message' => 'Hello World in PHP',
        'role' => 'user',
    ],
    [
        'message' => <<<MESSAGE
            echo "Hello World!";

            This code will print "Hello World!" to the standard output.
            MESSAGE,
        'role' => 'model',
    ],
];
$chat = Gemini::startChat($history);

print $chat->sendMessage('in Go');
// fmt.Println("Hello World!")
// This code will print "Hello World!" to the standard output.
```

### Text Embeddings

```php
use GeminiAPI\Laravel\Facades\Gemini;

print_r(Gemini::embedText('PHP in less than 100 chars'));
// [
//    [0] => 0.041395925
//    [1] => -0.017692696
//    ...
// ]
```

### Tokens counting

```php
use GeminiAPI\Laravel\Facades\Gemini;

print Gemini::countTokens('PHP in less than 100 chars');
// 10
```

### Listing models

```php
use GeminiAPI\Laravel\Facades\Gemini;

print_r(Gemini::listModels());
//[
//  [0] => GeminiAPI\Resources\Model Object
//    (
//      [name] => models/gemini-pro
//      [displayName] => Gemini Pro
//      [description] => The best model for scaling across a wide range of tasks
//      ...
//    )
//  [1] => GeminiAPI\Resources\Model Object
//    (
//      [name] => models/gemini-pro-vision
//      [displayName] => Gemini Pro Vision
//      [description] => The best image understanding model to handle a broad range of applications
//      ...
//    )
//]
```

### Accessing the underlying Gemini API client

```php
use GeminiAPI\Laravel\Facades\Gemini;

$client = Gemini::client();
```

### Parsing the markdown response from the model

```php
    {{ Illuminate\Mail\Markdown::parse($response) }}
```
