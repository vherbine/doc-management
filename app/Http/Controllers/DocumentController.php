<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\DocumentsExport;
use Maatwebsite\Excel\Facades\Excel;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;
use App\Document;

class DocumentController extends Controller
{
    public function index()
    {
        return Document::all();
    }

    public function show(Document $document)
    {
        return $document;
    }

    public function store(Request $request)
    {
	$meta = array('created_at' => date("Y-m-d H:i:s"), 
		'created_by' => $request->user()->email,
	        'updated_at' => date("Y-m-d H:i:s"),
		'updated_by' => $request->user()->email
	);
	$document = Document::create([
            'content' => $request->content,
            'meta' => $meta
        ]);

        return response()->json($document, 201);
    }

    public function update(Request $request, Document $document)
    {
	$updated_array = array(
                'updated_at' => date("Y-m-d H:i:s"),
                'updated_by' => $request->user()->email
        );
	$newmeta = array_replace($document->meta, $updated_array);

	$newcontent = array_replace($document->content, $request->content);
	
        $document->update([
            'content' => $newcontent,
            'meta' => $newmeta
        ]);

        return response()->json($document, 200);
    }

    public function delete(Document $document)
    {
        $document->delete();

        return response()->json(null, 204);
    }

    public function export(Request $request, Document $document)
    {
	$updated_array = array(
                'exported_at' => date("Y-m-d H:i:s"),
                'exported_by' => $request->user()->email
        );
	$newmeta = array_replace($document->meta, $updated_array);

        $document->update([
            'meta' => $newmeta
        ]);

        $format = (isset($request->format)) ? $request->format : 'csv';
        $service = (isset($request->service)) ? $request->service : 'download';

	if($format == "csv" && $service == "download"){
            Excel::store(new DocumentsExport($document), 'document.csv', 'public');
	    // return Storage::url('document.csv');
	    return asset('storage/document.csv');
	}

	if($format == "csv" && $service == "dropbox"){
	    $filename = '/document.csv';

            Excel::store(new DocumentsExport($document), $filename, 'dropbox');

            $link = $client->getTemporaryLink($filename);
            return $link;
	}
    }
}
