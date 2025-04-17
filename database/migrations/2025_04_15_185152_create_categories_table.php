<?php

use App\Models\Categories;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->double('priority')->default(0);
            $table->timestamps();
        });

        Categories::create(['name'=>'unsigned', 'description'=>'unsigned items', 'priority'=>0]);

        if (env('FILL_FAKE_DATA')) {
            Categories::create([
                'name'=>'Музыкальные сервисы',
                'description'=>'Сервисы наполняющие вашу жизнь музыкой',
                'priority'=>0]);

            Categories::create([
                'name' => 'Финансовые трекеры',
                'description' => 'Приложения для контроля бюджета, расходов и доходов',
                'priority' => 6
            ]);

            Categories::create([
                'name' => 'Фитнес и здоровье',
                'description' => 'Сервисы, помогающие следить за физической формой и самочувствием',
                'priority' => 5
            ]);

            Categories::create([
                'name' => 'Образовательные платформы',
                'description' => 'Инструменты для онлайн-обучения и саморазвития',
                'priority' => 7
            ]);

            Categories::create([
                'name' => 'Игровые лаунчеры',
                'description' => 'Программы для запуска и управления коллекцией игр',
                'priority' => 2
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
