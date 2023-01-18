<?php

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Group;
use App\Models\Recurrence;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('value');
            $table->dateTime('payment_date')->nullable();
            $table->dateTime('scheduled_payment_date');
            $table->foreignIdFor(Attachment::class)->nullable()->constrained();
            $table->foreignIdFor(Group::class)->constrained();
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Recurrence::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
