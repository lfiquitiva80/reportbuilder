<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel;

set_time_limit(18000);
ini_set('memory_limit', '-1');


class QueriesExport implements FromCollection,ShouldQueue,Responsable,WithHeadings
{

    use Exportable;



    private $fileName = 'QueriesExport.csv';

    private $writerType = Excel::CSV;

    private $query;

    private $col;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function __construct($vista) 
    {
        $this->vista = $vista;
      
    }


    //$ayer=Carbon::yesterday();
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
          
      
      $sql='select * from '. $this->vista;

      
      $this->query=collect(\DB::connection('sqlserver')->select(\DB::raw($sql)));
            
      
    return $this->query;
  
    }

       public function headings(): array
    {
          $sql2= "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$this->vista' ORDER BY ordinal_position";  
          $this->col= collect(\DB::connection('sqlserver')->select(\DB::raw($sql2)))->toArray();
            
                foreach ($this->col as $key => $value) {
                    
                    $var[]=$value->COLUMN_NAME;

                  }
                  return [
                   $var
                  ];      

                
        
    }
}