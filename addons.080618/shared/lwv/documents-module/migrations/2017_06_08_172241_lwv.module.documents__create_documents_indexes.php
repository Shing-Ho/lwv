<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDocumentsCreateDocumentsIndexes extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('documents_folders', function($table)
        {
            $table->index('parent_id');
        });

        Schema::table('documents_documents', function($table)
        {
            $table->index('folder_id');
        });

        Schema::table('documents_resolutions', function($table)
        {
            $table->index('minutes_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

    }
}
