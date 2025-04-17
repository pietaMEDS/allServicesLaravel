<?php

use App\Models\Products;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('logo');
            $table->unsignedBigInteger('category_id');
            $table->double('priority')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });

        if (env('FILL_FAKE_DATA')){
            Products::create([
                'name' => 'VK Music',
                'description' => 'Музыкальное приложение',
                'logo' => 'http://127.0.0.1:8000/storage/products/gp3jE0VESe2rBFYU6jBjDMOb1VWJQy8isMuu5VKI.png',
                'category_id' => 2,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'CoinTrack',
                'description' => 'Личный финансовый менеджер для учёта расходов и доходов',
                'logo' => 'http://127.0.0.1:8000/storage/products/18Um7YVuKHATnQU9b8WoRHGy90mq2cNTNMLTDXE2.svg',
                'category_id' => 3,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'FitLife',
                'description' => 'Фитнес-приложение с трекером тренировок и питания',
                'logo' => 'http://127.0.0.1:8000/storage/products/kQVothyPLyx26jSSAjnRfruZouuUPdBDWKTUwFYp.png',
                'category_id' => 4,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'SmartLearn',
                'description' => 'Онлайн-платформа для изучения языков и наук',
                'logo' => 'http://127.0.0.1:8000/storage/products/vpYYnJzEoJYLZEgQmm2T4V6OzMDjlMEQJpY37mA2.jpg',
                'category_id' => 5,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'PlayBox',
                'description' => 'Игровой лаунчер с коллекцией популярных тайтлов',
                'logo' => 'http://127.0.0.1:8000/storage/products/MjQrhIvqVkjSAdyCQkrNzIkER7xbXU7ZCmCRCY3S.jpg',
                'category_id' => 6,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'BudgetMate',
                'description' => 'Планирование бюджета с визуальными отчётами',
                'logo' => 'http://127.0.0.1:8000/storage/products/IweyhXKJnnPjSzUOpxjP9ZBJoPAiACyw7oyaeJD7.png',
                'category_id' => 3,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'PaySafe',
                'description' => 'Приложение для безопасных онлайн-платежей',
                'logo' => 'http://127.0.0.1:8000/storage/products/0IEbJDEGVyU72YcIWAgnXtoZQVFxvR5gIL6FhVjw.png',
                'category_id' => 3,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'CryptoWatcher',
                'description' => 'Мониторинг криптовалют и уведомления по курсу',
                'logo' => 'http://127.0.0.1:8000/storage/products/Xcdu8JOfWm9fH2hA1ocNAwKJaFkNnz3yDfYCa3lM.png',
                'category_id' => 3,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'RunBuddy',
                'description' => 'Трекер пробежек и активности с GPS',
                'logo' => 'http://127.0.0.1:8000/storage/products/pB97oQXNay7moyA9sY8ELCChP2N0AdMjnKNK3rFB.jpg',
                'category_id' => 4,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'YogaFlow',
                'description' => 'Йога-сессии и дыхательные практики',
                'logo' => 'http://127.0.0.1:8000/storage/products/tSb6XirWEETAIkwOCUuAOaMakIBHltUr6V4g7Skm.jpg',
                'category_id' => 4,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'MealPlan Pro',
                'description' => 'Планировщик питания и расчёт калорий',
                'logo' => 'http://127.0.0.1:8000/storage/products/SkCJDktx9907BTnTdSF4o74adGjbz1emPPehPDJe.png',
                'category_id' => 4,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'LangGo',
                'description' => 'Мобильный тренажёр по изучению иностранных слов',
                'logo' => 'http://127.0.0.1:8000/storage/products/EaofUDjIM9IVGgkcXKC525vwoPhIeNZWgzi0nTvO.png',
                'category_id' => 5,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'CodeCraft',
                'description' => 'Интерактивное обучение программированию',
                'logo' => 'http://127.0.0.1:8000/storage/products/xMSrpGCqXCpm32gcvd3axQIEZYBsJYv26voxLd6P.jpg',
                'category_id' => 5,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'QuizArena',
                'description' => 'Тесты и квизы по различным школьным предметам',
                'logo' => 'http://127.0.0.1:8000/storage/products/QnTbrNwkme9Z27FKI9KrTf6eth2n7N5s7y5wVB2t.jpg',
                'category_id' => 5,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'PixelPlay',
                'description' => 'Коллекция инди-игр с оффлайн-режимом',
                'logo' => 'http://127.0.0.1:8000/storage/products/yEGBmxA5V1tFUFhbvu9ONXktmUJXnjLAqNmcjmoQ.jpg',
                'category_id' => 6,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'ArenaHub',
                'description' => 'Сервис для запуска онлайн-турниров и PvP-матчей',
                'logo' => 'http://127.0.0.1:8000/storage/products/zYDtGPt7m3TaiOZvb3wbrhkLfbyhHwPTHaXj0YTR.jpg',
                'category_id' => 6,
                'priority' => 0
            ]);

            Products::create([
                'name' => 'GameNest',
                'description' => 'Платформа подписки на десятки премиум-игр',
                'logo' => 'http://127.0.0.1:8000/storage/products/GmNG5yb1YijKS7pg9PX8v7DXdsUm63dnlRDVnlT7.png',
                'category_id' => 6,
                'priority' => 0
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
