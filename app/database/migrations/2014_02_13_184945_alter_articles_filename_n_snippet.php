<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterArticlesFilenameNSnippet extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('articles', function($table)
            {
                $table->dropColumn('filename', 'snippet');
            });
            Schema::table('articles', function($table)
            {
                $table->string('snippet', 500)->after('urls');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('articles', function($table)
            {
                $table->string('filename')->after('subject');
                $table->string('snippet')->after('filename');
            });
            Schema::table('articles', function($table)
            {
                $table->dropColumn('snippet');
            });
	}

}
