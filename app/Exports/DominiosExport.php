<?php

namespace App\Exports;

use App\Dominio;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DominiosExport extends BaseExport implements FromCollection,  ShouldAutoSize, WithHeadings, WithMapping,
    WithColumnFormatting
{
    /**
     * Esta propriedade armazena a coleção de dados que serão impressos da planilha
     *
     * @var Collection $collection
     */
    protected $collection;

    /**
     * Cria uma nova instância desta classe. Recebe como parâmetro uma coleção que será usada para alimentar a planilha
     *
     * DominiosExport constructor.
     * @param $collection
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Retorna a coleção de dados para a planilha
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    /**
     * Informa qual o cabeçalho da planilha
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            [
                'A' => 'DOMÍNIOS',
                ''
            ],
            [
                'A' => 'ID',
                'B' => 'NOME',
                'C' => 'TLD',
                'D' => 'DATA CRIAÇÃO'
            ]
        ];
    }

    /**
     * Trata os dados que serão impressos da planilha. Ex: conversões para tipos excel
     *
     * @param mixed $row
     * @return array
     * @throws \Exception
     */
    public function map($row): array
    {
        return [
            'A' => $row->id,
            'B' => $row->nome,
            'C' => $row->tld,
            'D' => $this->dateOrNull($row->created_at)
        ];
    }

    /**
     * Formata os tipos de dados das colunas
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
