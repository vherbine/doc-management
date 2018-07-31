<?php
namespace App\Exports;

use App\Document;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentsExport implements FromCollection, WithHeadings
{
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function collection()
    {
	$rows[0]['key'] = 'key';
	$rows[0]['value'] = 'value';
	$i = 1;
        foreach($this->document->content as $key => $value){
	    $rows[$i]['key'] = $key;
	    $rows[$i]['value'] = $value;
	    $i++;
	}
        return collect($rows);
    }

    public function headings(): array
    {
        $heading = 'creation date: ' . $this->document->created_at . ' last update date: ' . $this->document->updated_at;
        return [
	    $heading
        ];
    }
}
