<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\QueriesExport;

class ProcessQuery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $vista;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($vista)
    {
         $this->vista=$vista;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            $file = $this->vista . '.csv';
            (new QueriesExport($this->vista))->store($file);
        //(new QueriesExport($this->vista))->queue('invoices.xlsx');
   
    }
}
