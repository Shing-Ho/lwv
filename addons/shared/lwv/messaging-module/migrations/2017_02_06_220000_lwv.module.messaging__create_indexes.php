<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleMessagingCreateIndexes extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('messaging_queue', function($table)
        {
            $table->index(array('processed'));
            $table->index(array('type','processed'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('messaging_queue', function($table)
        {
            $table->dropIndex('messaging_queue_processed_index');
            $table->dropIndex('messaging_queue_type_processed_index');
        });

    }
}
