<?php

use App\Http\Controllers\TaskAiSuggestionController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tasks');

Route::post('/tasks/{task}/ai-suggestion', [TaskAiSuggestionController::class, 'store'])
    ->name('tasks.ai-suggestion.store');

Route::resource('tasks', TaskController::class);
