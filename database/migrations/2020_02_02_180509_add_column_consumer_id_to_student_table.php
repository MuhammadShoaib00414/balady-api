<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddColumnConsumerIdToStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('consumer_id')
                ->nullable()
                ->after('national_id');
        });

        DB::statement('ALTER TABLE students MODIFY sub_municipality BIGINT;');    
        DB::statement('ALTER TABLE students MODIFY municipality BIGINT;');    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('consumer_id');
        });
    }
}
