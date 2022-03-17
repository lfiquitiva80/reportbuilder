<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel;

set_time_limit(3000000);
ini_set('memory_limit', '-1');


class ConsultaExport implements FromCollection,ShouldQueue,Responsable,WithHeadings
{

    use Exportable;

    


    private $fileName = 'ConsultaExport.csv';

    private $writerType = Excel::CSV;

    private $query;

    private $col;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function __construct($consulta,$columnas) 
    {
        $this->consulta = $consulta;
        $this->columnas = $columnas;
      
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
              

      
      $this->query=collect(\DB::connection('sqlserver')->select(\DB::raw($this->consulta)));
            
      
    return $this->query;
    }

  
      public function headings(): array
    {
          
                  return [
                   
                   $this->columnas

                  ];      

                
        
    }

}
