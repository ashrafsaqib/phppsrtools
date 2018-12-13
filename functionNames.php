<?php 

function convertSetterGetterToCamelCaseInFile($file){
	
    $content=file_get_contents($file);
    preg_match_all('/(?:set|get).+_.+\(/', $content, $matches);
    $content=replaceFound($content,$matches[0]);
    //print_r($matches[0]);
    file_put_contents($file,$content);
	
}


function replaceFound($content,array $find){
    $replace=[];
    foreach($find as $index=>$item){
        $letter_pos=(int)(strpos($item,'_'))+1;
        if($letter_pos>1)
            $item[$letter_pos]=strtoupper($item[$letter_pos]);
        


        $letter_pos=(int)(strpos($item,'_',$letter_pos))+1;
        if ($letter_pos > 1) {
            $item[$letter_pos] = strtoupper($item[$letter_pos]);
        }

        $letter_pos=(int)(strpos($item,'_',$letter_pos))+1;
        if ($letter_pos > 1) {
            $item[$letter_pos] = strtoupper($item[$letter_pos]);
        }

        $replace[$index]=str_replace('_','',$item);
    }
    

    $content=str_replace($find,$replace,$content);

    return $content;
}

foreach(scandir('yourdirectory') as $file){
	if(is_file('yourdirectory\\'.$file))
		convertSetterGetterToCamelCaseInFile('yourdirectory\\'.$file);
}
