<?php

    function exportCsv(string $filename, array $headers, array $data): void 
    {   
        if(ob_get_level()){
            ob_end_clean();
            }
    }
    
    $safeName = preg_replace('/[^A-Za-z0-9_-]/', '', $filename);
    $safeName = '_' .date('Y-m-d_H-i-s') . '.csv';

    header('Content-type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="'.$safeName.'"');
    header('Pragma: no cache');
    header('Expires:0');

    $out = fopen('php://output', 'w');
    fputcsv($out, $headers);

    foreach($data as $row){
        fputcsv($out, array_values($row));
    }

    fclose($out);

    exit;

?>