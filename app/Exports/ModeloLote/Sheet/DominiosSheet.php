<?php


namespace App\Exports\ModeloLote\Sheet;


use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DominiosSheet implements WithHeadings, WithTitle, WithEvents,  ShouldAutoSize, WithStyles
{
    public function title(): string
    {
        return 'Domínios';
    }

    public function headings(): array
    {
        return [
            'Nome',
            'TLD',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize('12');
        $sheet->getStyle('A1:B1')->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFDDDDDD');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $this->listaTiposProcesso($event->sheet->getDelegate());
            },
        ];
    }

    private function listaTiposProcesso(Worksheet $sheet)
    {
        for ($i=2; $i<=400; $i++){
            $validation = $sheet->getCell('C'.$i)->getDataValidation();
            $validation->setType(DataValidation::TYPE_LIST );
            $validation->setErrorStyle( DataValidation::STYLE_INFORMATION );
            $validation->setAllowBlank(false);
            $validation->setShowInputMessage(true);
            $validation->setShowErrorMessage(true);
            $validation->setShowDropDown(true);
            $validation->setErrorTitle('Entrada Inválida');
            $validation->setError('O valor não está na lista');
            $validation->setPromptTitle('Selecione da lista');
            $validation->setPrompt('Escolha um valor na lista suspensa');
            $validation->setFormula1("='Tipo de Processo'!\$B$2:\$B$79");
        }
    }
}
