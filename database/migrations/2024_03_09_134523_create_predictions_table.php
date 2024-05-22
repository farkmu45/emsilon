<?php

use App\Models\Group;
use App\Models\Species;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Group::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Species::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->float('ems_concentration', unsigned: true);
            $table->unsignedInteger('first_soak_duration');
            $table->unsignedInteger('second_soak_duration');
            $table->float('lowest_temperature', unsigned: true);
            $table->float('highest_temperature', unsigned: true);
            $table->boolean('result');
            $table->unsignedMediumInteger('success_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
