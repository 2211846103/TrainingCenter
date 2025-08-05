<?php

namespace App\Console\Commands;

use App\Models\Course;
use Illuminate\Console\Command;

class ArchiveCourses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'courses:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archives courses whose end date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $archivedCount = Course::whereDate('end_date', '<', now())
            ->where('status', '!=', 'archived')
            ->update([
                'status' => 'archived',
            ]);

        $this->info("Archived $archivedCount course(s).");
    }
}