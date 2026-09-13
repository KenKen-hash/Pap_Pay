<?php

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
        Schema::create('official_businesses', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Employee
            |--------------------------------------------------------------------------
            | Each employee files their own Official Business request.
            */

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | General Information
            |--------------------------------------------------------------------------
            */

            // Purpose of the Official Business
            $table->text('purpose');

            // Start date of the Official Business
            $table->date('ob_date');

            // End date of the Official Business
            // Nullable so existing/single-day OB requests remain possible.
            $table->date('ob_date_to')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Estimated Cost
            |--------------------------------------------------------------------------
            | These fields correspond to the Estimated Cost section
            | of the employee frontend form.
            */

            // Transportation / Gasoline
            $table->decimal('transportation_cost', 12, 2)
                  ->default(0);

            // Meals
            $table->decimal('meals_cost', 12, 2)
                  ->default(0);

            // Lodging
            $table->decimal('lodging_cost', 12, 2)
                  ->default(0);

            // Others
            $table->decimal('others_cost', 12, 2)
                  ->default(0);

            // Registration Fee
            $table->decimal('registration_fee', 12, 2)
                  ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Proof Documents
            |--------------------------------------------------------------------------
            | Stores uploaded proof/attachment file paths as JSON.
            */

            $table->json('proof_images')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

            // Admin/user who approved the OB
            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // Date and time when the OB was approved
            $table->timestamp('approved_at')->nullable();

            // Reason provided when the OB is rejected
            $table->text('rejection_reason')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_businesses');
    }
};
