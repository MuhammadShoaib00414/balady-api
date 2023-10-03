<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('bankIban');
            $table->string('Name');
            $table->string('birthDate');
            $table->string('email');
            $table->string('gender');
            $table->string('identityNumber');
            $table->string('mobileNumber');
            $table->string('observationType');
            $table->string('subMunicipalityId');
            $table->string('subMunicipalityName');
            $table->string('MunicipalityId');
            $table->string('status');
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
        Schema::dropIfExists('certificates');
    }
}
